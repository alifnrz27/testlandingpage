<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;
use App\Models\Portofolio as PortofolioModels;
use App\Models\PortofolioFeature;

class Portofolio extends Component
{
    public $isShow="",
    $show_data = "",
    $show_portofolio="",
    $portofolios=[],
    $errorMessages=[],
    $is_update = false,

    $id_portofolio='',
    $id_feature = "",
    $type = 1,
    $title = "",
    $subtitle = "",
    $price_first_time = "",
    $price= "",
    $discount = "",
    $hint = "",
    $name = "";
    public function mount(){
        $this->portofolios = PortofolioModels::get();
    }

    public function showPortofolio($id){
        $this->show_portofolio = PortofolioModels::where([
            'id' => $id,
        ])->with(['features'])->first();
        $this->emit('showDetailPortofolio', true);
    }

    public function showFormPortofolio($id){
        $show_portofolio = PortofolioModels::where([
            'id' => $id,
        ])->with(['features'])->first();

        $this->title = $show_portofolio->title;
        $this->subtitle = $show_portofolio->subtitle;
        $this->price = $show_portofolio->price;
        $this->price_first_time = $show_portofolio->price_first_time;
        $this->discount = $show_portofolio->discount;
        $this->is_update=true;
        $this->id_portofolio = $show_portofolio->id;

        $this->mount();
    }

    public function showFormFeature($id){
        $show_feature = PortofolioFeature::where([
            'id' => $id,
        ])->first();

        $this->name = $show_feature->name;
        $this->hint = $show_feature->hint;
        $this->is_update=true;
        $this->id_feature = $show_feature->id;

        $this->mount();
    }

    public function deletePortofolio($id){
        PortofolioModels::where([
            'id' => $id,
        ])->delete();

        PortofolioFeature::where([
            'portofolio_id' => $id,
        ])->delete();

        $this->mount();
        $this->dispatchBrowserEvent('modal', [
            'type' => 'success',
            'title'=> 'Berhasil menghapus data',
            'text'=>'',
        ]);
    }

    public function deleteFeature($id){
        PortofolioFeature::where([
            'id' => $id,
        ])->delete();

        $this->showPortofolio($this->show_portofolio['id']);
        $this->dispatchBrowserEvent('modal', [
            'type' => 'success',
            'title'=> 'Berhasil menghapus data',
            'text'=>'',
        ]);
    }


    public function submitPortofolio(){
        $customMessages = [
            'title.required' => 'Title wajib diisi.',
            'subtitle.required' => 'Subtitle wajib diisi.',
            'type.required' => 'Type wajib diisi.',
            'price_first_time.required' => "Harga pertama beli wajib diisi.",
            'price.required' => 'Harga wajib diisi.',
            'discount.required' => 'Diskon wajib diisi.',
        ];
        $validated = [
            'title' => ['required'],
            'subtitle' => ['required'],
            'type' => ['required'],
            'price_first_time' => ['required'],
            'price' => ['required'],
            'discount' => ['required']
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
            return;
        }

        PortofolioModels::create([
            'title' => $this->title,
            'subtitle' => $this->subtitle,
            'price_first_time' => $this->price_first_time,
            'price' => $this->price,
            'type' => $this->type,
            'discount' => $this->discount,
        ]);

        $this->emit("showFormPortofolio", false);
        $this->clearForm();
        $this->mount();
        $this->dispatchBrowserEvent('modal', [
            'type' => 'success',
            'title'=> 'Berhasil menyimpan data',
            'text'=>'',
        ]);


    }

    public function updatePortofolio(){
        $customMessages = [
            'title.required' => 'Title wajib diisi.',
            'subtitle.required' => 'Subtitle wajib diisi.',
            'type.required' => 'Type wajib diisi.',
            'price_first_time.required' => "Harga pertama beli wajib diisi.",
            'price.required' => 'Harga wajib diisi.',
            'discount.required' => 'Diskon wajib diisi.',
        ];
        $validated = [
            'title' => ['required'],
            'subtitle' => ['required'],
            'type' => ['required'],
            'price_first_time' => ['required'],
            'price' => ['required'],
            'discount' => ['required']
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
            return;
        }

        PortofolioModels::where(['id' => $this->id_portofolio])->update([
            'title' => $this->title,
            'subtitle' => $this->subtitle,
            'price_first_time' => $this->price_first_time,
            'type' => $this->type,
            'price' => $this->price,
            'discount' => $this->discount,
        ]);

        $this->emit("showFormPortofolio", false);
        $this->clearForm();
        $this->mount();
        $this->dispatchBrowserEvent('modal', [
            'type' => 'success',
            'title'=> 'Berhasil menyimpan data',
            'text'=>'',
        ]);


    }

    public function submitFeature(){
        $customMessages = [
            'name.required' => 'Nama wajib diisi.',
            'hint.required' => 'Info wajib diisi.',
        ];
        $validated = [
            'name' => ['required'],
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
            return;
        }

        PortofolioFeature::create([
            'portofolio_id' => $this->show_portofolio['id'],
            'name' => $this->name,
            'hint' => $this->hint,
        ]);

        $this->emit("showFormFeature", false);
        $this->clearForm();
        $this->showPortofolio($this->show_portofolio['id']);
        $this->dispatchBrowserEvent('modal', [
            'type' => 'success',
            'title'=> 'Berhasil menyimpan data',
            'text'=>'',
        ]);


    }

    public function updateFeature(){
        $customMessages = [
            'name.required' => 'Nama wajib diisi.',
            'hint.required' => 'Info wajib diisi.',
        ];
        $validated = [
            'name' => ['required'],
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
            return;
        }

        PortofolioFeature::
        where(['id' => $this->id_feature])->
        update([
            'name' => $this->name,
            'hint' => $this->hint,
        ]);

        $this->emit("showFormFeature", false);
        $this->clearForm();
        $this->showPortofolio($this->show_portofolio['id']);
        $this->dispatchBrowserEvent('modal', [
            'type' => 'success',
            'title'=> 'Berhasil menyimpan data',
            'text'=>'',
        ]);


    }

    public function clearForm(){
        $this->is_update=false;
        $this->errorMessages=[];
        $this->id_feature = "";
        $this->type = 1;
        $this->id_portofolio="";
        $this->title = "";
        $this->subtitle = "";
        $this->price_first_time = "";
        $this->price= "";
        $this->discount = "";
        $this->hint = "";
        $this->name = "";
    }

    public function render()
    {
        return view('livewire.admin.portofolio');
    }
}
