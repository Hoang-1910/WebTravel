<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\User;
use App\Mail\AccountCreatedMail;
use Illuminate\Support\Facades\Mail;

class UserController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');
    
        $users = User::when($search, function ($query, $search) {
            return $query->where('name', 'like', "%$search%")
                         ->orWhere('email', 'like', "%$search%");
        })->paginate(10);
    
        // Đính kèm query vào các link phân trang
        $users->appends(['search' => $search]);
    
        return view('admin.account_user.index', compact('users', 'search'));
    }
    
   
    public function create()
    {
        return view('admin.account_user.create');
    }


    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'phone' => 'required',
            'password' => 'required|min:6',
        ]);

        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->phone = $request->phone;
        $user->password = bcrypt($request->password);
        $user->save();

        return redirect()->route('admin.account_user.index')->with('success', 'Tài khoản đã được tạo!');
    }

    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->route('admin.account_user.index')->with('success', 'Đã xóa tài khoản!');
    }

    public function edit(User $user)
    {
        return view('admin.account_user.edit', compact('user'));
    }

    public function update(Request $request, User $user)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'phone' => 'required',
        ]);

        $user->name = $request->name;
        $user->email = $request->email;
        $user->phone = $request->phone;
        $user->save();

        return redirect()->route('admin.account_user.index');
    }

    public function show(User $user)
    {
        return view('admin.account_user.show', compact('user'));
    }
    
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:6',
        ]);
    
        $user = User::where('email', $request->email)->first();
    
        if ($user && Hash::check($request->password, $user->password)) {
            session(['user' => $user]);
    
            return redirect()->route('user.homepage')->with('success', 'Đăng nhập thành công!');
        }
    
        return redirect()->back()->with('error', 'Thông tin đăng nhập không chính xác.');
    }

    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'password' => 'required|string|min:6|confirmed',
        ]);

        // Kiểm tra trước khi tạo mới
        if (User::where('email', $request->email)->exists()) {
            return redirect()->back()
                ->withInput()
                ->withErrors(['email' => 'Email này đã được đăng ký!']);
        }

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
        ]);

        // Gửi email thông báo (nhưng không cần xác nhận)
        Mail::to($user->email)->send(new AccountCreatedMail($user));

        return redirect()->route('login')->with('success', 'Đăng ký thành công! Email thông báo đã được gửi.');
    }





    public function forgotPassword(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
        ]);

        $user = User::where('email', $request->email)->first();

        if (!$user) {
            return back()->with('error', 'Email không tồn tại trong hệ thống.');
        }

        // Đặt lại mật khẩu thành "123456"
        $user->password = Hash::make('123456');
        $user->save();

        return back()->with('success', 'Mật khẩu của bạn đã được đặt lại thành 123456. Vui lòng đăng nhập lại.');
    }

    public function profile()
    {
        $user = auth()->user();
        return view('user.profile', compact('user'));
    }


    public function updateProfile(Request $request)
    {
        $user = Auth::user(); // Lấy thông tin user hiện tại

        $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'nullable|string|max:20',
            'birthday' => 'nullable|date',
            'address' => 'nullable|string|max:255',
        ]);

        // Cập nhật thông tin
        User::where('id', $user->id)->update([
            'name' => $request->name,
            'phone' => $request->phone,
            'birthday' => $request->birthday,
            'address' => $request->address,
        ]);

        return redirect()->route('user.profile')->with('success', 'Cập nhật thông tin thành công!');
    }



        public function editProfile()
    {
        return view('user.edit_profile');
    }

    public function showChangePasswordForm()
    {
        return view('user.change-password'); // Giao diện đổi mật khẩu
    }

    public function updatePassword(Request $request)
    {
        $request->validate([
            'current_password' => 'required',
            'new_password' => 'required|min:6|confirmed',
        ]);

        $user = Auth::user();

        // Kiểm tra mật khẩu cũ
        if (!Hash::check($request->current_password, $user->password)) {
            return back()->withErrors(['current_password' => 'Mật khẩu cũ không chính xác.']);
        }

        // Cập nhật mật khẩu mới
        User::where('id', $user->id)->update([
            'password' => Hash::make($request->new_password),
        ]);

        return back()->with('success', 'Đổi mật khẩu thành công!');
    }



}
