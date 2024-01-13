<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;
use App\Models\Partner as PartnerModels;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class Partner extends Component
{
    protected $listeners = ['processCroppedImage' => 'processCroppedImage'];
    public
    $partners=[],

    $id_partner="",
    $partner_image="",
    $previous_partner_image="",
    $name = "",
    $is_update=false,
    $errorMessages=[];


    public function mount(){
        $this->partners = PartnerModels::get();
    }

    public function clearForm(){
        $this->id_partner="";
        $this->partner_image="";
        $this->previous_partner_image="";
        $this->name = "";
        $this->is_update=false;
        $this->errorMessages=[];
    }

    public function processCroppedImage($data){
        $this->partner_image = $data;
        $this->emit('showformPartner', true);
    }

    public function updatePartner(){
        $customMessages = [
            'name.required' => 'Nama wajib diisi.',
            'partner_image.required' => "Gambar wajib diisi.",
        ];

        try {
            $this->validate([
                'name' => ['required'],
                'partner_image' => ['required'],
            ], $customMessages);
        } catch (\Illuminate\Validation\ValidationException $e) {
            // Get the validation errors and emit them as an event
            $errorMessages = $e->validator->getMessageBag();
            $this->errorMessages = [];
            foreach ($errorMessages->toArray() as $key => $messages) {
                $this->errorMessages[$key] = $messages;
            }
            // dd($this->errorMessages);
            $this->emit('closeLoader', false);
            return;
        }

        $path = $this->partner_image;
        if(substr($this->partner_image, 0, 4) == "data"){
            $imageData = base64_decode(preg_replace('#^data:image/\w+;base64,#i', '', $this->partner_image));
            $pathToSave = storage_path('app/public/imagesPartner'); // Ganti dengan direktori yang sesuai
            $imageName = uniqid() . '.png'; // Nama file unik dengan ekstensi .png
            $imagePath = $pathToSave . '/' . $imageName;
            $path = "imagesPartner/".$imageName;
            file_put_contents($imagePath, $imageData);
            if (File::exists(public_path('storage/'.$this->previous_partner_image))) {
                File::delete(public_path('storage/'.$this->previous_partner_image));
            }
        }

        PartnerModels::where(['id' => $this->id_partner])->update([
            'name' => $this->name,
            'partner_image' => $path,
        ]);

        $this->clearForm();
        $this->mount();
        $this->emit('showformPartner', false);
    }

    public function submitPartner(){
        $customMessages = [
            'name.required' => 'Nama wajib diisi.',
            'partner_image.required' => "Gambar wajib diisi.",
        ];

        try {
            $this->validate([
                'name' => ['required'],
                'partner_image' => ['required'],
            ], $customMessages);
        } catch (\Illuminate\Validation\ValidationException $e) {
            // Get the validation errors and emit them as an event
            $errorMessages = $e->validator->getMessageBag();
            $this->errorMessages = [];
            foreach ($errorMessages->toArray() as $key => $messages) {
                $this->errorMessages[$key] = $messages;
            }
            // dd($this->errorMessages);
            $this->emit('closeLoader', false);
            return;
        }

        if(substr($this->partner_image, 0, 4) == "data"){
            $imageData = base64_decode(preg_replace('#^data:image/\w+;base64,#i', '', $this->partner_image));
            $pathToSave = storage_path('app/public/imagesPartner'); // Ganti dengan direktori yang sesuai
            $imageName = uniqid() . '.png'; // Nama file unik dengan ekstensi .png
            $imagePath = $pathToSave . '/' . $imageName;
            $path = "imagesPartner/".$imageName;
            file_put_contents($imagePath, $imageData);
        }

        PartnerModels::create([
            'name' => $this->name,
            'partner_image' => $path,
        ]);

        $this->clearForm();
        $this->mount();
        $this->emit('showformPartner', false);
    }

    public function deletePartner($id){
        $partner = PartnerModels::where([
            'id' => $id,
        ])->first();

        if (File::exists(public_path('storage/'.$partner->partner_image))) {
            File::delete(public_path('storage/'.$partner->partner_image));
        }
        PartnerModels::where([
            'id' => $id,
        ])->delete();
        $this->mount();
    }

    public function showformPartner($id){
        $partner = PartnerModels::where([
            'id' => $id,
        ])->first();
        $this->id_partner = $partner->id;
        $this->name = $partner->name;
        $this->partner_image = $partner->partner_image;
        $this->previous_partner_image = $partner->partner_image;
        $this->is_update=true;
    }

    public function render()
    {
        return view('livewire.admin.partner');
    }
}
