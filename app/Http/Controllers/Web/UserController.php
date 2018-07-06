<?php

namespace App\Http\Controllers\Web;

use App\Models\User;
use App\Notifications\confirmEmail;
use jeremykenedy\LaravelRoles\Models\Role;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Validator;
use Redirect;
use Auth;
use Hash;

class UserController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users=User::all();
        return view('dashboard.manageusers', ['users' => $users]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dashboard.createuser');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator=Validator::Make($request->all(),
            [
                'username' => 'required|min:6|max:255|unique:users',
                'password' => 'required|min:6|max:20',
                'role' => 'required'
            ]
        )->validate();
        
        $user = new User();
        $user->username = $request->input('username');
        $user->temp_password = $request->input('password');
        $user->password = bcrypt($request->input('password'));
        $user->save();

        $role = Role::where('name', '=', $request->input('role'))->first();
        $user->attachRole($role);

        return redirect()->route('user.index')->with('status', 'Usuario Creado!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        return view('dashboard.showuser', ['user' => $user]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        return view('dashboard.edituser', ['user' => $user]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        if (!$user)
        {
            return response()->json(['message' => 'ID de usuario no existe.', 'type' => 'error', 'code' => 404], 404);
        }
        $rules=[];
        if($request->input('first_name')){
            $rules['first_name'] = 'required|min:3|max:32';
        }
        if($request->input('last_name')){
            $rules['last_name'] = 'required|min:3|max:32';
        }
        if($request->input('old_password')){
            $rules['old_password'] = 'required|min:6';
        }
        if($request->input('email')){
            $rules['email'] = 'required|email|confirmed|unique:users';
        }
        if($request->input('password')){
            $rules['password'] = 'required|confirmed|min:6|max:20';
        }
        $validator=Validator::Make($request->all(), $rules);

        if ($validator->fails()) {
            return response()->json(['message' => $validator->errors(), 'type' => 'error', 'code' => 100], 200);
        }
        if($request->input('password') && (!Hash::check($request->input('old_password'), $user->password)))
        {
            return response()->json(['message' => 'La contraseña actual es incorrecta', 'type' => 'info', 'code' => 200], 200);
        }
        
        $first_name=$request->input('first_name');
        $last_name=$request->input('last_name');
        $email=$request->input('email');
        $password=bcrypt($request->input('password'));

        $bandera = false;

        if ($first_name)
        {
            $user->first_name = $first_name;
            $bandera=true;
        }

        if ($last_name)
        {
            $user->last_name = $last_name;
            $bandera=true;
        }

        if ($email)
        {
            if($user->email != $email)
            {
                $user->email = $email;
                $user->confirmed = false;
                $bandera=true;
            }
        }

        if ($password)
        {
            $user->password = $password;
            $bandera=true;
        }

        if ($bandera)
        {
            $user->save();
            return response()->json(['message'=>'Datos actualizados.', 'type'=>'success', 'code' => 300], 200);
        }
        else
        {
            return response()->json(['message'=>'No se ha modificado ningun dato.', 'type'=>'info', 'code'=>400],200);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        if(Auth::user()->isAdmin())
        {
            $user->delete();
            return response()->json(['message' => 'Usuario Eliminado.', 'code' => 204], 200);
        }
        else {
            return response()->json(['message' => 'No tienes permisos.', 'code' => 403], 403);
        }
    }

    public function uploadAvatar(Request $request, $idUser){

    }

    public function getAvatar($idUser){

    }

    public function showChangePassword()
    {
        return view('dashboard.userchangepassword');
    }

    public function changePassword(Request $request)
    {
        $validator=Validator::Make($request->all(),
            [
                'password' => 'required|confirmed|min:6'
            ]
        )->validate();
        $user=Auth::user();
        if($user)
        {
            $user->password=bcrypt($request->input('password'));
            $user->temp_password="";
            $user->activated=true;
            $user->save();
            return redirect()->route('dashboard.home');
        }
        else {
            return redirect()->route('login');
        }
    }
    public function resetPassword($iduser)
    {
        if(Auth::user()->isAdmin())
        {
            $alphabet = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890';
            $pass = [];
            $alphaLength = \strlen($alphabet) - 1;
            for ($i = 0; $i < 8; $i++) {
                $n = rand(0, $alphaLength);
                $pass[] = $alphabet[$n];
            }
            $pass = \implode($pass);
            $user=User::all()->find($iduser);
            if($user)
            {
                $user->password=\bcrypt($pass);
                $user->temp_password=$pass;
                $user->activated=false;
                $user->save();
                return response()->json(['message' => 'Contraseña restablecida.', 'code' => 204], 200);
            }
            else {
                return response()->json(['message' => 'Usuario no existe.', 'code' => 404], 404);
            }
        }
        else {
            return response()->json(['message' => 'No tienes permisos.', 'code' => 403], 403);
        }
    }
    public function confirmEmail($email_token)
    {
        $user=User::where('email_token', $email_token)->firstOrFail();
        if($user)
        {
            $user->update(['email_token' => null, 'confirmed' => true]);
            return redirect()->route('user.show', ['id'=>$user->id])->with('success', 'Email confirmado');
        }
    }
    public function sendConfirmEmail($id)
    {
        $user=User::all()->find($id);
        $token = str_random(24);
        $user->email_token = $token;
        $user->save();
        $user->notify(new confirmEmail($user));
        return redirect()->route('user.show', ['id'=>$user->id])->with('success', 'Se ha enviado un correo de verificacion, reviza tu buson.');
    }
}
