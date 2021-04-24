<?php

namespace App\Http\Controllers\API\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

use App\Models\Siswa as SiswaModel;
use App\Models\User as UserModel;

use App\Http\Resources\SiswaCollection as SiswaRes;

class SiswaController extends Controller
{
    private static $context = 'Siswa';

    function __construct()
    {
        $this->middleware(['auth:api', 'rolecheck:admin']);
    }

    private function term($request, $id = null)
    {
        /**
         * Username need user id to check unique
         * It places on guru table on data_of column
         * $userid variable contain data_of
         * 
         * @return null when $id is null
         * @return data_of
         */
        $userId = isset($id) ? (SiswaModel::find($id)->data_of ?? null) : null;

        return Validator::make($request->all(), [
            'password' => 'required|min:3|max:255',
            'password_conf' => 'required|same:password',
            'profile_pict' => 'image',

            'nisn' => 'required|digits:10|unique:siswa,NISN,'.$id.',id',
            'name' => 'required|max:100',
            'gender' => 'required|in:m,f',
            'whatsapp' => 'required|unique:siswa,whatsapp,'.$id.',id',
            'address' => 'required',
            'birth_date' => 'required|date',
            'student_pict' => 'image',
            'class_id' => 'required|numeric'
        ]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $siswa = SiswaRes::collection(SiswaModel::with(['user', 'class'])->get());
        
        return generateAPI(['data' => $siswa, 'custom_lenght' => count($siswa), 'message' => generateAPIMessage(['context' => Self::$context, 'type' => 'read'])]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = $this->term($request);
        if($validator->fails()) return generateAPI(['data' => $validator->messages()->toArray(), 'message' => 'Validation Error', 'code' => 403, 'status' => false]);

        $userModel = new UserModel;
        $userModel->username = $request->nisn;
        $userModel->password = bcrypt($request->password);
        $userModel->foto_profil = $request->profile_pict ?? 'default.jpg';
        $userModel->role = 'siswa';
        $userModel->save();

        $siswaModel = new SiswaModel;
        $siswaModel->data_of = $userModel->id;
        $siswaModel->NISN = $request->nisn;
        $siswaModel->nama = $request->name;
        $siswaModel->jk = $request->gender == 'm' ? 'l' : 'p';
        $siswaModel->whatsapp = $request->whatsapp;
        $siswaModel->alamat = $request->address;
        $siswaModel->tanggal_lahir = $request->birth_date;
        $siswaModel->foto_siswa = $request->student_pict ?? 'siswa.jpg';
        $siswaModel->id_kelas = $request->class_id;
        $siswaModel->save();

        return generateAPI(['status' => true, 'message' => generateAPIMessage(['context' => self::$context, 'type' => 'create']), 'data' => $siswaModel]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $id = intval(preg_replace('/[\D]/', '', $id)) ?: null;

        $siswaModel = SiswaModel::with(['user', 'class'])->find($id);
        if(!isset($siswaModel)) return generateAPI(['status' => false, 'code' => 404, 'message' => generateAPIMessage(['context' => self::$context, 'type' => 'find', 'id' => $id], false)]);

        $siswaData = SiswaRes::make($siswaModel);
        return generateAPI(['data' => $siswaData, 'message' => generateAPIMessage(['context' => Self::$context, 'type' => 'find', 'id' => $id])]);
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
        $id = intval(preg_replace('/[\D]/', '', $id)) ?: null;
        
        $validator = $this->term($request, $id);
        if($validator->fails()) return generateAPI(['data' => $validator->messages()->toArray(), 'message' => 'Validation Error', 'code' => 403, 'status' => false]);

        $siswaModel = SiswaModel::find($id);
        if(!isset($siswaModel)) return generateAPI(['status' => false, 'code' => 404, 'message' => generateAPIMessage(['context' => self::$context, 'type' => 'update', 'id' => $id], false)]);

        $siswaModel->user->username = $request->nisn;
        $siswaModel->user->password = bcrypt($request->password);
        $siswaModel->user->foto_profil = $request->profile_pict ?? $siswaModel->user->foto_profil;

        $siswaModel->NISN = $request->nisn;
        $siswaModel->nama = $request->name;
        $siswaModel->jk = $request->gender == 'm' ? 'l' : 'p';
        $siswaModel->whatsapp = $request->whatsapp;
        $siswaModel->alamat = $request->address;
        $siswaModel->tanggal_lahir = $request->birth_date;
        $siswaModel->id_kelas = $request->class_id;
        $siswaModel->save();

        return generateAPI(['status' => true, 'message' => generateAPIMessage(['context' => self::$context, 'type' => 'update', 'id' => $id]), 'data' => $siswaModel]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $id = intval(preg_replace('/[\D]/', '', $id)) ?: null;

        $siswaModel = SiswaModel::find($id);
        if(!isset($siswaModel)) return generateAPI(['status' => false, 'code' => 404, 'message' => generateAPIMessage(['context' => self::$context, 'type' => 'update', 'id' => $id], false)]);

        $siswaModel->user->delete();
        $siswaModel->delete();

        return generateAPI(['status' => true, 'message' => generateAPIMessage(['context' => self::$context, 'type' => 'delete', 'id' => $id])]);
    }
}
