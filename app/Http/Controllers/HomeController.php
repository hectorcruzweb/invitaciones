<?php

namespace App\Http\Controllers;

use App\Invitados;
use Illuminate\Http\Request;
use Illuminate\Support\Env;
use PhpParser\Node\Stmt\Foreach_;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //$this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return redirect('invitacion');
    }

    public function invitacion(Request $request)
    {
        if (isset($request->data)) {
            $invitado = INVITADOS::where('id', '=', base64_decode($request->data))->get();
            if (count($invitado) == 0) {
                return redirect('home');
            }
            $invitado[0]['key'] = base64_encode($invitado[0]['id']);

            $invitado[0]['link'] = Env('APP_URL') . 'invitacion?data=' .  $invitado[0]['key'];
            return view('welcome', ['data' => $invitado[0]]);
        } else {
            //echo 'Error';
            return redirect('/login');
        }
    }


    public function home()
    {
        $invitados = INVITADOS::get()->toArray();
        foreach ($invitados as &$invitado) {
            if ($invitado['status'] == 0) {
                $invitado['status_texto'] = 'Sin confirmar';
            } else  if ($invitado['status'] == 1) {
                $invitado['status_texto'] = 'Si asistirá';
            } else {
                $invitado['status_texto'] = 'No asistirá';
            }

            $id = $invitado['id'];
            $key = base64_encode($id);
            $invitado['link'] = Env('APP_URL') . 'invitacion?data=' . $key;
            $text = str_replace(' ', "%20", 'Hola ' . $invitado['invitado'] . ', te invitamos a nuestra boda. Haz click aquí para confirmar tu asistencia. ' . Env('APP_URL') . 'invitacion?data=' . $key);
            $invitado['url'] = 'https://api.whatsapp.com/send?phone=+52' . $invitado['whatsapp'] . '&text=' . $text;
        }
        return view('home', ['invitados' => $invitados]);
    }

    public function confirmar(Request $request)
    {
        $request->validate([
            // 'nombre'          => 'required',
            'key'         => 'required',
            'confirmar'         => 'required',
            'pases'        => 'required'
        ]);

        $id = base64_decode($request->key);

        $confirmar = $request->confirmar;
        $pases_aceptados = $confirmar == 1 ? $request->pases  : 0;
        try {
            INVITADOS::where('id', '=', $id)->update(array('status' => $confirmar, 'pases_confirmados' => $pases_aceptados));
            return response()->json(['success' => $confirmar], 200);
        } catch (Exception $e) {
            return response()->json(['success' => 'Successfully'], 401);
        }


        /*$contact = new Contact;
        $contact->name = $request->name;
        $contact->email = $request->email;
        $contact->mobile = $request->mobile;
        $contact->message = $request->message;
        $contact->save();*/
    }
}
