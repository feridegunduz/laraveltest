<?php

namespace App\Http\Controllers;

use App\Models\User;
use Faker\Factory;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function randomCreate()
    {
        $faker = Factory::create();

        $user = new User();
        $user->name = $faker->name;
        $user->email = $faker->email;
        $user->password = bcrypt('password');

        // Diğer alanları da ekleyebilirsiniz

        $user->save();

        return 'Rastgele kullanıcı oluşturuldu.';
    }
    public function index(Request $request)
    {
        $users = User::paginate(20); // Sayfada 10 kullanıcı göstermek için, isteğe bağlı olarak istediğiniz değeri verebilirsiniz


        return view('users.index', compact('users'));
    }
    public function randomCreateMultiple($n)
    {
        for ($i = 0; $i < $n; $i++) {
            $faker = Factory::create();

            $user = new User();
            $user->name = $faker->name;
            $user->email = $faker->email;
            $user->password = bcrypt('password');


            $user->save();
        }

        return $n . ' adet rastgele kullanıcı oluşturuldu.';
    }
    public function search(Request $request)
    {
        $searchTerm = $request->input('search');

        $users = User::where('name', 'like', '%'.$searchTerm.'%')
            ->orWhere('email', 'like', '%'.$searchTerm.'%')
            ->paginate(10);

        return view('users.index', compact('users'));
    }
    public function destroy($id)
    {
        $user = User::find($id);

        if (!$user) {
            return redirect()->route('users.index')->with('error', 'Kullanıcı bulunamadı.');
        }

        $user->delete();

        return redirect()->route('users.index')->with('success', 'Kullanıcı başarıyla silindi.');
    }

}

