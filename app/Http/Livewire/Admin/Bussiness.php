<?php

namespace App\Http\Livewire\Admin;

use App\Models\Brand;
use App\Models\Claim;
use App\Models\Promotion;
use App\Models\Store;
use App\Models\subdomain as Subdomain;
use App\Models\User;
use App\Models\RequestNewUser;
use Livewire\Component;
use Livewire\WithFileUploads;

class Bussiness extends Component
{
    use WithFileUploads;
    public
    $search = "",
    $searchCustomer="",
    $searchClaim="",
    $companies = [],
    $request_website = [],
    $detailCompany = "",
    $expired_date="",
    $detailClaim="",
    $company_name = '',
    $subdomain = '',
    $temporary_subdomain= '',
    $username = '',
    $temporary_username = "",
    $password = '',
    $passwordConfirmation = '',
    $image_path,
    $branches = [],
    $total_shopping = '0',
    $point = '0',
    $status= true,
    $statusClaim=true,
    $is_claim = 1,
    $allStores=[],
    $customers = [],
    $vouchers= [],
    $gifts = [],
    $promotions = [],
    $errorMessages = [];
    public function render()
    {
        if($this->detailCompany){
            $this->queryCustomers();
            $this->queryVouchers();
            $this->queryGifts();
            $this->queryPromotions();
        }
        $this->companies = Brand::where([
            ['company_name', 'like', '%'.$this->search."%"]
        ])->with(['stores', 'vouchers', 'gifts', 'promotions'])->latest()->get();
        return view('livewire.admin.bussiness');
    }

    public function validateCompany(){
        $customMessages = [
            'company_name.required' => 'Nama perusahaan wajib diisi.',
            'subdomain.required' => 'Nama domain wajib diisi.',
            'expired_date.required' => 'Tanggal expired wajib diisi.',
            'subdomain.unique' => "Domain sudah digunakan.",
            'username.required' => "Username wajib diisi.",
            'username.unique' => "Username sudah digunakan.",
            'password.required' => 'Password wajib diisi.',
            'password.min' => 'Password minimal 8 karakter.',
            'password.same' => 'Password tidak cocok dengan konfirmasi password.',
            'image_path.max' => 'Ukuran file max 8 MB.',
        ];
        $validated = [
            'company_name' => ['required'],
            'expired_date' => ['required'],
            'subdomain' => ['required', 'unique:subdomains,name'],
            'username' => ['required', 'unique:users'],
            'password' => ['required', 'min:8', 'same:passwordConfirmation'],
        ];

        if($this->image_path != null) {
            $validated = [
                ...$validated,
                'image_path' => ['required', 'max:8192'],
            ];
        }
        try {
            $this->validate($validated, $customMessages);
            $this->emit('nextForm', true);
            $this->errorMessages = [];
        } catch (\Illuminate\Validation\ValidationException $e) {
            // Get the validation errors and emit them as an event
            $errorMessages = $e->validator->getMessageBag();
            $this->errorMessages = [];
            foreach ($errorMessages->toArray() as $key => $messages) {
                $this->errorMessages[$key] = $messages;
            }
        }


    }

    public function validateBranch($branches){
        $this->branches = $branches;
        foreach ($branches as $index => $branch) {
            if($branch['name'] == "" || $branch['address'] == "" || $branch['province'] == "" || $branch['city'] == "" || $branch['subdistrict'] == "" || $branch['urban_village'] == "" || $branch['postal_code'] == "" || $branch['username'] == "" || $branch['password'] == ""){
                $this->dispatchBrowserEvent('modal', [
                    'type' => 'error',
                    'title'=> 'Data harus lengkap',
                    'text'=>'',
                ]);
                return;
            }

            foreach ($branches as $innerIndex => $innerBranch) {
                if ($index !== $innerIndex && $branch['username'] === $innerBranch['username']) {
                    $this->dispatchBrowserEvent('modal', [
                        'type' => 'error',
                        'title'=> 'Tiap username harus berbeda',
                        'text'=>'',
                    ]);
                    return;
                }
                if($branch['username'] === $this->username){
                    $this->dispatchBrowserEvent('modal', [
                        'type' => 'error',
                        'title'=> 'Username harus berbeda dengan company',
                        'text'=>'',
                    ]);
                    return;
                }
            }

            $checkUser = User::where(['username' => $branch['username']])->first();
            if($checkUser){
                $this->dispatchBrowserEvent('modal', [
                    'type' => 'error',
                    'title'=> 'Salah satu username sudah digunakan',
                    'text'=>'',
                ]);
                return;
            }

            if ($branch['password'] !== $branch['passwordConfirmation']) {
                $this->dispatchBrowserEvent('modal', [
                    'type' => 'error',
                    'title'=> 'Salah satu password tidak sama dengan konfirmasi password',
                    'text'=>'',
                ]);
                return;
            }
        }

        $this->emit('nextForm', true);
    }

    public function validateExxhange(){
        $customMessages = [
            'total_shopping.required' => 'Jumlah belanja wajib diisi.',
            'point.required' => "Point wajib diisi.",
        ];
        $validated = [
            'total_shopping' => ['required'],
            'point' => ['required'],
        ];

        try {
            $this->validate($validated, $customMessages);
            $this->submitForm();
            $this->errorMessages = [];
        } catch (\Illuminate\Validation\ValidationException $e) {
            // Get the validation errors and emit them as an event
            $errorMessages = $e->validator->getMessageBag();
            $this->errorMessages = [];
            foreach ($errorMessages->toArray() as $key => $messages) {
                $this->errorMessages[$key] = $messages;
            }
        }
    }

    public function submitForm(){
        $subdomain = Subdomain::create([
            // 'name' => str_replace(" ","-",strtolower($this->company_name)),
            'name' => $this->subdomain,
        ]);

        $owner = User::create([
            'name' => $this->company_name,
            'role_id' => 2,
            'email' => '',
            'subdomain_id' => $subdomain['id'],
            'username' => $this->username,
            'password' => bcrypt($this->password),
        ]);

        $dataSubmit = [
            'user_id' => $owner->id,
            'total_shopping' => str_replace(".","",$this->total_shopping) ,
            'point' => $this->point,
            'expired_date' => $this->expired_date,
            'company_name' => $this->company_name

        ];

        if($this->image_path != null) {
            // Simpan gambar ke folder imagesPromotion dalam direktori storage
            $path = $this->image_path->store('imagesBrand', 'public');
            $this->image_path = null;
            $dataSubmit = [
                ...$dataSubmit,
                'image_path' => $path,
            ];
        }
        else{
            $dataSubmit = [
                ...$dataSubmit,
                'image_path' => '',
            ];
        }
        $brand = Brand::create($dataSubmit);

        foreach ($this->branches as $index => $branch) {
            $user = User::create([
                'name' => "Admin " . $branch['name'],
                'subdomain_id' => $owner->subdomain_id,
                'role_id' => 3,
                'username' => $branch['username'],
                'password'=> bcrypt($branch['password']),
            ]);

            Store::create([
                'user_id' => $user->id ,
                'brand_id' => $brand->id ,
                'name' => $branch['name'] ,
                'address' => $branch['address'] ,
                'province' => $branch['province'] ,
                'city' => $branch['city'] ,
                'subdistrict' => $branch['subdistrict'] ,
                'urban_village' => $branch['urban_village'] ,
                'postal_code' => $branch['postal_code'] ,
            ]);

            $this->mount();
            $this->resetForm();
            $this->emit('closeForm', true);
        }
    }

    public function updateProfileCompany(){
        $customMessages = [
            'company_name.required' => 'Nama perusahaan wajib diisi.',
            'expired_date.required' => 'Tanggal wajib diisi.',
            'subdomain.required' => 'Nama domain wajib diisi.',
            'subdomain.unique' => "Domain sudah digunakan.",
            'username.required' => "Username wajib diisi.",
            'username.unique' => "Username sudah digunakan.",
            'password.required' => 'Password wajib diisi.',
            'password.min' => 'Password minimal 8 karakter.',
            'password.same' => 'Password tidak cocok dengan konfirmasi password.',
            'image_path.max' => 'Ukuran file max 8 MB.',
        ];
        $validated = [
            'company_name' => ['required'],
            'expired_date' => ['required'],
        ];

        if($this->username == $this->temporary_username) {
            $validated = [
                ...$validated,
                'username' => ['required'],
            ];
        }else{
            $validated = [
                ...$validated,
                'username' => ['required', 'unique:users'],
            ];
        }

        if($this->subdomain == $this->temporary_subdomain) {
            $validated = [
                ...$validated,
                'subdomain' => ['required'],
            ];
        }else{
            $validated = [
                ...$validated,
                'subdomain' => ['required', 'unique:subdomains,name'],
            ];
        }

        if($this->password){
            $validated = [
                ...$validated,
                'password' => ['required', 'min:8', 'same:passwordConfirmation'],
            ];
        }
        try {
            $this->validate($validated, $customMessages);
            $this->errorMessages = [];
        } catch (\Illuminate\Validation\ValidationException $e) {
            // Get the validation errors and emit them as an event
            $errorMessages = $e->validator->getMessageBag();
            $this->errorMessages = [];
            foreach ($errorMessages->toArray() as $key => $messages) {
                $this->errorMessages[$key] = $messages;
            }
            $this->emit('showDetailForm', true);
        }

        $dataSubmit = [
            'username' => $this->username,
            'name' => $this->company_name,
        ];

        if($this->password != null) {
            $dataSubmit = [
                ...$dataSubmit,
                'password' => bcrypt($this->password),
            ];
        }

        User::where([
        'id' => $this->detailCompany['user_id']
        ])->update($dataSubmit);

        Brand::where([
            'id' => $this->detailCompany['id']
        ])->update([
            'expired_date' => $this->expired_date,
            'company_name' => $this->company_name,
            'status' => $this->status
        ]);

        $owner = User::where(['id' => $this->detailCompany['user_id']])->first();
        Subdomain::where(['id' => $owner->subdomain_id])->update([
            'name' => $this->subdomain
        ]);

        $this->mount();
        $this->emit('showDetailForm', false);
    }

    public function updatePoint(){
        $customMessages = [
            'total_shopping.required' => 'Jumlah belanja wajib diisi.',
            'point.required' => "Point wajib diisi.",
        ];
        $validated = [
            'total_shopping' => ['required'],
            'point' => ['required'],
        ];

        try {
            $this->validate($validated, $customMessages);
            $this->errorMessages = [];
        } catch (\Illuminate\Validation\ValidationException $e) {
            // Get the validation errors and emit them as an event
            $errorMessages = $e->validator->getMessageBag();
            $this->errorMessages = [];
            foreach ($errorMessages->toArray() as $key => $messages) {
                $this->errorMessages[$key] = $messages;
            }
        }

        Brand::where([
            'id' => $this->detailCompany['id']
        ])->update([
            'total_shopping' => str_replace(".","",$this->total_shopping),
            'point' => $this->point,
        ]);

        $this->mount();
        $this->emit('showDetailPoint', false);
    }

    public function detailCompany($id){
        $this->detailCompany = Brand::with(['stores', 'vouchers', 'gifts', 'promotions'])->where('id', $id)->first();
        $owner = User::where(['id' => $this->detailCompany['user_id']])->first();
        $subdomain = Subdomain::where(['id' => $owner->subdomain_id])->first();
        $this->subdomain = $subdomain->name;
        $this->expired_date = $this->detailCompany->expired_date;
        $this->temporary_subdomain = $subdomain->name;
        $this->company_name = $this->detailCompany['company_name'];
        $this->total_shopping = number_format($this->detailCompany['total_shopping'],0,",",".");
        $this->point = $this->detailCompany['point'];
        $this->username = $owner->username;
        $this->temporary_username = $owner->username;
        $this->status= $this->detailCompany['status'];
        $this->render();
        $this->emit('showDetail', true);
    }

    public function detailClaim($id, $is_claim){
        $this->is_claim = $is_claim;
        if($is_claim == 1){
            $this->detailClaim = Claim::where(['id' => $id])->with(['claimStores', 'claimStores.store'])->first();
            $this->allStores = $this->detailClaim['claimStores'];
        }else{
            $this->detailClaim = Promotion::where(['id' => $id])->with(['promotionStores', 'promotionStores.store'])->first();
            $this->allStores = $this->detailClaim['promotionStores'];
        }
        $this->statusClaim = $this->detailClaim['status_by_admin'];
        $this->emit("showDetailClaim", true);
    }

    public function changeStatus(){
        $this->status = !$this->status;
    }

    public function changeStatusStore($id){
        $temporaryStore = Store::where([
            'id' => $id
        ])->first();

        Store::where([
            'id' => $id
        ])->update([
            'status_by_admin' => !$temporaryStore['status_by_admin']
        ]);

        $this->detailCompany($this->detailCompany['id']);
        $this->render();
    }

    public function changeStatusClaim(){
        $this->statusClaim = !$this->statusClaim;
    }

    public function saveClaim(){
        if($this->is_claim == 1){
            Claim::where([
                'id' => $this->detailClaim['id']
            ])->update([
                'status_by_admin' => $this->statusClaim
            ]);
        }else{
            Promotion::where([
                'id' => $this->detailClaim['id']
            ])->update([
                'status_by_admin' => $this->statusClaim
            ]);
        }
        $this->emit("showDetailClaim", false);
    }

    public function resetForm(){
        $this->search = "";
        $this->searchCustomer="";
        $this->expired_date="";
        $this->searchClaim="";
        $this->companies = [];
        $this->detailCompany = "";
        $this->subdomain="";
        $this->temporary_subdomain="";
        $this->detailClaim="";
        $this->company_name = '';
        $this->username = '';
        $this->temporary_username = "";
        $this->password = '';
        $this->passwordConfirmation = '';
        $this->image_path = null;
        $this->branches = [];
        $this->total_shopping = '0';
        $this->point = '0';
        $this->status= true;
        $this->statusClaim=true;
        $this->is_claim = 1;
        $this->allStores=[];
        $this->customers = [];
        $this->vouchers= [];
        $this->gifts = [];
        $this->promotions = [];
        $this->errorMessages = [];
    }

    public function queryCustomers(){
        $owner = User::where(['id' => $this->detailCompany['user_id']])->first();
        $this->customers = User::where([
            ["subdomain_id", '=', $owner['subdomain_id']],
            ["role_id", '=',4],
            ['name', 'like', "%".$this->searchCustomer."%"],
        ])
        ->orWhere([
            ["subdomain_id", '=', $owner['subdomain_id']],
            ["role_id", '=',4],
            ['phone_number', 'like', "%".$this->searchCustomer."%"],
        ])
        ->with(['claimmed', 'claimmed.claim'])
        ->get();
    }

    public function queryVouchers(){
        $this->vouchers = Claim::where([
            ['brand_id', '=', $this->detailCompany['id']],
            ['claim_type_id', '=', 1],
            ['title', 'like', '%' . $this->searchClaim . '%']
        ])->with(['claimStores', 'claimmed'])->latest()->get();
    }

    public function queryGifts(){
        $this->gifts = Claim::where([
            ['brand_id', '=', $this->detailCompany['id']],
            ['claim_type_id', '=', 2],
            ['title', 'like', '%' . $this->searchClaim . '%']
        ])->with(['claimStores', 'claimmed'])->latest()->get();
    }

    public function queryPromotions(){
        $this->promotions = Promotion::where([
            ['brand_id', '=', $this->detailCompany['id']],
            ['title', 'like', '%' . $this->searchClaim . '%']
        ])->with(['promotionStores'])->latest()->get();
    }

    public function openRequestBusiness(){
        $this->request_website = RequestNewUser::where([
            'status' => 0,
        ])->with(['referal'])->get();
    }

    public function acceptRequestBusiness($request_id){
        RequestNewUser::where([
            'id' => $request_id,
        ])->update([
            'status' => 1
        ]);

        $this->openRequestBusiness();

        $this->dispatchBrowserEvent('modal', [
            'type' => 'success',
            'title'=> 'Berhasil menyimpan data',
            'text'=>'',
        ]);
    }

    public function removeImage(){
        $this->image_path = '';
    }

}
