<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCustomerRequest;
use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->has('order') && $request->order == 'asc') {
            $order = 'ASC';
        } else {
            $order = 'DESC';
        }

        $customers = Customer::when($request->has('keyword'), function ($query) use ($request) {
            $query->where('first_name', 'LIKE', "%$request->keyword%")
                ->orWhere('last_name', 'LIKE', "%$request->keyword%")
                ->orWhere('phone', 'LIKE', "%$request->keyword%")
                ->orWhere('email', 'LIKE', "%$request->keyword%");
        })
            ->orderBy('id', $order)
            ->get();

        return view('customer.index', compact('customers'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('customer.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCustomerRequest $request)
    {
        $customer = new Customer();

        // Optional.
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $storedFileName = $image->store('', 'public');
            $filePath = '/uploads/' . $storedFileName;
            $customer->image = $filePath;
        }

        $customer->first_name = $request->first_name;
        $customer->last_name = $request->last_name;
        $customer->email = $request->email;
        $customer->phone = $request->phone;
        $customer->bank_account_number = $request->bank_account_number;
        $customer->about = $request->about;

        $customer->save();

        return redirect()->route('customers.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Customer $customer)
    {
        return view('customer.show', compact('customer')); // compact('customer') 함수는 ['customer' => $customer]를 반환한다.
    }

    /**
     * Show the form for editing the specified resource.
     *
     * 모델 클래스 타입 힌트를 통해 모델 바인딩(모델 인스턴스 주입)이 가능해진다.
     */
    public function edit(Customer $customer)
    {
        return view('customer.edit', compact('customer'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StoreCustomerRequest $request, Customer $customer)
    {
        if ($request->hasFile('image')) {
            // 기존 이미지 파일 삭제하기.
            Storage::disk('public')->delete($customer->image);

            $image = $request->file('image');
            $storedFileName = $image->store('', 'public');
            $filePath = '/uploads/' . $storedFileName;
            $customer->image = $filePath;
        }

        $customer->first_name = $request->first_name;
        $customer->last_name = $request->last_name;
        $customer->email = $request->email;
        $customer->phone = $request->phone;
        $customer->bank_account_number = $request->bank_account_number;
        $customer->about = $request->about;

        $customer->save();

        return redirect()->route('customers.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Customer $customer)
    {
        Storage::disk('public')->delete($customer->image);
        $customer->delete();

        return redirect()->route('customers.index');
    }
}
