<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\UserAddress;
use App\Http\Requests\UserAddressRequest;

class UserAddressesController extends Controller
{
    // 收货地址主页面
    public function index(Request $request)
    {
        return view('user_addresses.index', [
            'addresses' => $request->user()->addresses,
        ]);
    }

    // 新增收获地址
    public function create()
    {
        return view('user_addresses.create_and_edit', [
            'address' => new UserAddress()
        ]);
    }

    // 表单验证
    public function store(UserAddressRequest $request)
    {
        $request->user()->addresses()->create($request->only([
            'province',
            'city',
            'district',
            'address',
            'zip',
            'contact_name',
            'contact_phone',
        ]));

        return redirect()->route('user_addresses.index');
    }

    // 编辑地址页面
    public function edit(UserAddress $user_address)
    {
        // 用户权限校验
        $this->authorize('own', $user_address);

        return view('user_addresses.create_and_edit', ['address' => $user_address]);
    }

    // 修改地址
    public function update(UserAddress $user_address, UserAddressRequest $request)
    {
        // 用户权限校验
        $this->authorize('own', $user_address);

        $user_address->update($request->only([
            'province',
            'city',
            'district',
            'address',
            'zip',
            'contact_name',
            'contact_phone',
        ]));

        return redirect()->route('user_addresses.index');
    }

    // 删除地址
    public function destroy(UserAddress $user_address)
    {
        // 用户权限校验
        $this->authorize('own', $user_address);

        $user_address->delete();

        // return redirect()->route('user_addresses.index');
        return [];  // 请求方式变为AJAX请求，因此改为返回空数组
    }

}
