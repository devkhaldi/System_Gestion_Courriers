<?php

// Status des consultations :
// vue ou nonvue

// Status des envois :
// nonvalide ou valide ou rejete

namespace App\Http\Controllers;

use App\Courrier;
use App\Envoi;
use App\Service;
use App\Consultation;
use App\Piecejointe;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;


class CourrierController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    // Status courrier for all informations of satut

    public function statuscourrier($id)
    {
        if (Auth::user()->type == 'admin') {
            $services = DB::table('envois')
                ->join('services', 'services.id', '=', 'envois.service_id')
                ->select('services.id', 'services.nom', 'envois.status')
                ->where('envois.courrier_id', '=', $id)
                ->get();

            $employes = DB::table('consultations')
                ->join('users', 'users.id', '=', 'consultations.user_id')
                ->select('users.service_id', 'users.name', 'consultations.status')
                ->where('consultations.courrier_id', '=', $id)
                ->get();
            return Response()->json(['services' => $services, 'employes' => $employes]);
        }
    }

    // Get status courrier for display footer
    public function status($id)
    {
        if (Auth::user()->type == 'chefservice') {
            $status = DB::table('envois')
                ->join('courriers', 'courriers.id', '=', 'envois.courrier_id')
                ->select('envois.status')
                ->where([['courriers.id', '=', $id], ['envois.service_id', '=', Auth::user()->service_id]])
                ->get();
            return $status;
        }
    }

    // search
    public function search(Request $request)
    {
        $this->validate($request, [
            'query' => 'required'
        ]);
        $query = $request->input('query');
        if (Auth::user()->type == 'admin') {
            $courriers = DB::table('courriers')
                ->select('courriers.*')
                ->where('num', '=', $query)
                ->orWhere('titre', 'like', '%' . $query . '%')
                ->get();
            return view('admin.search', ['courriers' => $courriers]);
        } else if (Auth::user()->type == 'chefservice') {
            $courriers = DB::table('envois')
                ->join('services', 'services.id', '=', 'envois.service_id')
                ->join('courriers', 'courriers.id', '=', 'envois.courrier_id')
                ->select('courriers.*')
                ->where([
                    ['envois.service_id', '=', Auth::user()->service_id],
                    ['courriers.num', '=', $query]
                ])
                ->orWhere([
                    ['envois.service_id', '=', Auth::user()->service_id],
                    ['courriers.titre', 'like', '%' . $query . '%']
                ])
                ->get();

            return view('chefservice.search', ['courriers' => $courriers]);
        } else if (Auth::user()->type == 'emp') {
            // if user type is employee
            $courriers = DB::table('consultations')
                ->join('users', 'users.id', '=', 'consultations.user_id')
                ->join('courriers', 'courriers.id', '=', 'consultations.courrier_id')
                ->select('courriers.*')
                ->where([
                    ['users.id', '=', Auth::user()->id],
                    ['courriers.num', '=', $query]
                ])
                ->orWhere([
                    ['users.id', '=', Auth::user()->id],
                    ['courriers.titre', 'like', '%' . $query . '%']
                ])
                ->get();
            return view('emp.search', ['courriers' => $courriers]);
        }
    }


    // Employee methods

    public function nonvue()
    {
        $courriers = DB::table('consultations')
            ->join('users', 'users.id', '=', 'consultations.user_id')
            ->join('courriers', 'courriers.id', '=', 'consultations.courrier_id')
            ->select('courriers.*')
            ->where([
                ['users.id', '=', Auth::user()->id],
                ['consultations.status', '=', 'nonvue']
            ])
            ->get();
        return view('emp.nonvue', ['courriers' => $courriers]);
    }

    public function vue()
    {
        $courriers = DB::table('consultations')
            ->join('users', 'users.id', '=', 'consultations.user_id')
            ->join('courriers', 'courriers.id', '=', 'consultations.courrier_id')
            ->select('courriers.*')
            ->where([
                ['users.id', '=', Auth::user()->id],
                ['consultations.status', '=', 'vue']
            ])
            ->get();
        return view('emp.vue', ['courriers' => $courriers]);
    }

    // chef service methodes


    public function nonvalide()
    {
        $courriers = DB::table('envois')
            ->join('services', 'services.id', '=', 'envois.service_id')
            ->join('courriers', 'courriers.id', '=', 'envois.courrier_id')
            ->select('courriers.*')
            ->where([
                ['services.user_id', '=', Auth::user()->id],
                ['envois.status', '=', 'nonvalide']
            ])
            ->get();

        return view('chefservice.nonvalide', ['courriers' => $courriers]);
    }

    public function valide()
    {
        $courriers = DB::table('envois')
            ->join('services', 'services.id', '=', 'envois.service_id')
            ->join('courriers', 'courriers.id', '=', 'envois.courrier_id')
            ->select('courriers.*')
            ->where([
                ['services.user_id', '=', Auth::user()->id],
                ['envois.status', '=', 'valide']
            ])
            ->get();
        return view('chefservice.valid', ['courriers' => $courriers]);
    }

    public function valider($id)
    {
        if (Auth::user()->type == 'chefservice') {
            $employees = DB::table('users')
                ->select('id', 'name', 'email', 'photo', 'service_id')
                ->where([['service_id', '=', Auth::user()->service_id], ['id', '<>', Auth::user()->id], ['service_id', '<>', null]])
                ->get();
            return view('chefservice.valide', ['employees' => $employees, 'courrier_id' => $id]);
        }
    }
    public function savevalidation(Request $request, $id)
    {
        if (Auth::user()->type == 'chefservice') {
            $this->validate($request, [
                'users' => 'required'
            ]);

            // update envois status to 'valide'
            DB::table('envois')
                ->where([['courrier_id', '=', $id], ['service_id', '=', Auth::user()->service_id]])
                ->update(['status' => 'valide']);
            // insert data into consultations
            $users_id = $request->input('users');
            foreach ($users_id as $user_id) {
                $consultation = new Consultation();
                $consultation->courrier_id = $id;
                $consultation->user_id = $user_id;
                $consultation->status = 'nonvue';
                $consultation->save();
            }
        } else redirect('/');
        return redirect('/');
    }

    // End chef service methodes
    public function index()
    {

        if (Auth::user()->type == 'emp') {
            /* 
            $courriers = DB::table('consultations')
                ->join('users', 'users.id', '=', 'consultations.user_id')
                ->join('courriers', 'courriers.id', '=', 'consultations.courrier_id')
                ->select('courriers.*')
                ->where([
                    ['consultations.user_id', '=', Auth::user()->id]
                ])
                ->get();
            */
            $courriersnonvues = DB::table('consultations')
                ->join('users', 'users.id', '=', 'consultations.user_id')
                ->join('courriers', 'courriers.id', '=', 'consultations.courrier_id')
                ->select('courriers.*')
                ->where([
                    ['users.id', '=', Auth::user()->id],
                    ['consultations.status', '=', 'nonvue']
                ])
                ->get();
            $courriersvues = $courriers = DB::table('consultations')
                ->join('users', 'users.id', '=', 'consultations.user_id')
                ->join('courriers', 'courriers.id', '=', 'consultations.courrier_id')
                ->select('courriers.*')
                ->where([
                    ['users.id', '=', Auth::user()->id],
                    ['consultations.status', '=', 'vue']
                ])
                ->get();
            //return view('emp.index', ['courriers' => $courriers]);
            return view('emp.index', ['courriersnonvues' => $courriersnonvues, 'courriersvues' => $courriersvues]);
        } else if (Auth::user()->type == 'admin') {
            $courriers = Courrier::all();
            return view('admin.index', ['courriers' => $courriers]);
        } else if (Auth::user()->type == 'chefservice') {
            /*
            $courriers = DB::table('envois')
                ->join('services', 'services.id', '=', 'envois.service_id')
                ->join('courriers', 'courriers.id', '=', 'envois.courrier_id')
                ->select('courriers.*')
                ->where([
                    ['services.user_id', '=', Auth::user()->id]
                ])
                ->get();
                */
            $courriersnonvalide = DB::table('envois')
                ->join('services', 'services.id', '=', 'envois.service_id')
                ->join('courriers', 'courriers.id', '=', 'envois.courrier_id')
                ->select('courriers.*')
                ->where([
                    ['services.user_id', '=', Auth::user()->id],
                    ['envois.status', '=', 'nonvalide']
                ])
                ->get();
            $courriersvalide = DB::table('envois')
                ->join('services', 'services.id', '=', 'envois.service_id')
                ->join('courriers', 'courriers.id', '=', 'envois.courrier_id')
                ->select('courriers.*')
                ->where([
                    ['services.user_id', '=', Auth::user()->id],
                    ['envois.status', '=', 'valide']
                ])
                ->get();
            //return view('chefservice.index', ['courriers' => $courriers]);
            return view('chefservice.index', ['courriersnonvalide' => $courriersnonvalide, 'courriersvalide' => $courriersvalide]);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (Auth::user()->type == 'admin') {
            $services = Service::all();
            return view('admin.create', ['services' => $services]);
        }
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if (Auth::user()->type == 'admin') {
            $this->validate($request, [
                'num' => 'required',
                'titre' => 'required',
                'objet' => 'required',
                'fichier' => 'required',
                'emetteur' => 'required'
            ]);

            //dd($request->all()) ;

            $courrier = new Courrier();
            $courrier->num = $request->input('num');
            $courrier->titre = $request->input('titre');
            $courrier->objet = $request->input('objet');
            $courrier->type = $request->input('type');
            $courrier->emetteur = $request->input('emetteur');
            $courrier->status = 'A';

            if ($request->hasFile('fichier')) {
                $courrier->fichier = $request->fichier->store('pdf');
            }
            $courrier->save();

            $services_id = $request->input('services');
            foreach ($services_id as $service_id) {
                $envoi = new Envoi();
                $envoi->courrier_id = $courrier->id;
                $envoi->service_id = $service_id;
                $envoi->status = 'nonvalide';
                $courrier->envois()->save($envoi);
            }

            $pjs = $request->file('piecejointe');
            foreach ($pjs as $pj) {

                $piecejointe = new Piecejointe();
                $piecejointe->courrier_id = $courrier->id;
                $piecejointe->fichier = $pj->store('piecejointe');
                $courrier->piecejointes()->save($piecejointe);
            }
            return redirect('/');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $courrier = Courrier::find($id);
        return $courrier;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (Auth::user()->type == 'admin') {
            $courrier = Courrier::find($id);
            return view('courrier.edit', ['courrier' => $courrier]);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        if (Auth::user()->type == 'admin') {
            $courrier = Courrier::find($id);
            $courrier->num = $request->input('num');
            $courrier->titre = $request->input('titre');
            $courrier->objet = $request->input('objet');
            $courrier->emetteur = $request->input('emetteur');
            $courrier->status = 'A';

            if ($request->hasFile('fichier')) {
                $courrier->fichier = $request->fichier->store('pdf');
            }
            $courrier->save();
            return redirect('courriers');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (Auth::user()->type == 'admin') {
            $courrier = Courrier::find($id);
            $courrier->delete();
        }
    }
    /* 
    private function getCourrierByStatus($status)
    {
        $courriers = DB::table('courriers')->where('status', '=', $status)->get();
        return $courriers;
    }
    private function getCourrierByEmetteur()
    {
        $courriers = DB::table('courriers')->where('emetteur', '=', $status)->get();
        return $courriers;
    }
    */
}
