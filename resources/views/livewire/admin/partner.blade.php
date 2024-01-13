<div>
    <div class="w-screen relative pt-3" x-data="{
        open:false,
        showRedeem:false,
        showRedeemConfirm:false,
        showOptionHistory:false,
        openConfirm:false,
        loading:false,
        notification:false,
        notificationSendClaim:false,
        notificationUndelivered:true,
        showRedeemNotification:false,
        showRedeemDetail:true,
        showHistoryRedeem:false,
        formPartner:false,
        }   " x-init="
        $wire.on('showDetailPortofolio', value => {
            open = value;
            loading=false;
            scrollToTop();
        });
        $wire.on('showformPartner', value => {
            formPartner = value;
            loading=false;
            scrollToTop();
        });
        $wire.on('showFormFeature', value => {
            formFeature = value;
            loading=false;
            scrollToTop();
        });
        $wire.on('closeLoader', value => {
            loading=false;
            scrollToTop();
        });
        $wire.on('detailSend', value => {
            detailSend=value;
            scrollToTop();
        });
        $wire.on('showRedeem', value => {
            showRedeem=value;
            showRedeemDetail=true;
            showHistoryRedeem=false;
            loading=false;
        });
        $wire.on('showRedeemConfirm', value => {
            showRedeemConfirm=value;
        });
        $wire.on('showOptionHistory', value => {
            showOptionHistory=value;
        });
        $wire.on('showHistoryRedeem', value => {
            showHistoryRedeem=value;
            showRedeemDetail = !value;
        });
        $wire.on('showRedeemNotification', value => {
            showRedeemNotification=true;
            loading=false;
            setTimeout(function() {
                showRedeemNotification=false;
            }, 2000);
        });
        $wire.on('showNotification', value => {
            notification=true;
            setTimeout(function() {
                notification=false;
            }, 2000);
        });
        $wire.on('showNotificationSendClaim', value => {
            notificationSendClaim=value;
            setTimeout(function() {
                notificationSendClaim=false;
            }, 5000);
        })

    " x-ref="scrollContainer">
        <div id="modal" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true" class="hidden fixed w-screen h-screen top-0 left-0 right-0 bottom-0" style="z-index: 200">
            <div class="absolute top-0 left-0 right-0 bottom-0 flex w-screen h-screen justify-center items-center bg-black bg-opacity-70">
                <div class="modal fade p-10 rounded-lg justify-center items-center w-[500px] h-fit bg-white" style="z-index: 200">
                    <div class="modal-dialog modal-lg" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true" class="text-[20px]">×</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <div class="img-container">
                                    <div class="row">
                                        <div class="col-md-8">
                                            <img id="image" class="w-[400px]">
                                        </div>
                                        <div class="col-md-4">
                                            <div class="preview"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div @click="loading=true" class="w-full flex gap-2 items-center justify-end mt-5">
                                <button type="button" style=" --tw-bg-opacity: 1;background-color: rgb(248 113 113 / var(--tw-bg-opacity)); color:white;" class="px-3 py-2 bg-red-400 rounded-lg text-white" data-dismiss="modal">Cancel</button>
                                <button type="button" @click="loading=true" style=" --tw-bg-opacity: 1;background-color: rgb(74 222 128 / var(--tw-bg-opacity)); color:white;" class="px-3 py-2 bg-green-400 rounded-lg text-white" id="crop">Crop</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div style="margin-top: 6rem" class="px-12 mt-24">
            <div x-cloak x-show="!open" class="w-full flex">
                <div class=" pr-0 md:pr-22">
                    <div class="w-full lg:flex">
                        <div class="w-full md:w-3/5 pr-0 md:pr-24">
                            <div>
                                <a href="{{ route('bussiness') }}" class="font-bold text-[16px] mb-10 cursor-pointer">
                                    <- Back
                                </a>
                                <div class="w-full lg:w-[550px] mb-10">
                                    <div style="font-weight: 700color:black;" class="text-[24px] text-dark-primary mb-2">
                                        Partner
                                    </div>
                                    <div style="font-weight: 400;" class="text-[16px] text-dark-primary">
                                        Di sini akan menampilkan partner website.
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="w-full justify-between lg:flex mt-12">
                        {{-- @if(auth()->user()->role_id == 2) --}}
                        <div class="w-2/12 flex items-center cursor-pointer no-select mt-4 lg:mt-0">
                            <div  @click="formPartner=true">
                                <button type="button" style="font-weight: 600;" class="flex text-white text-[16px] bg-primary p-3 rounded-sm">
                                    <div class="mr-1">
                                        +
                                    </div>
                                    <div class="hidden xl:block">
                                        Add new
                                    </div>
                                </button>
                            </div>
                        </div>
                        {{-- @endif --}}
                    </div>

                    <div class="w-full overflow-auto">
                        <table class="w-full min-w-[1336px] mt-6">
                            <thead class="items-center h-[68px] text-gray-500 text-[16px]">
                                <th class="border" style="width:312px">NAMA</th>
                                <th class="border" style="width:250px">
                                    <div class="flex justify-center items-center">
                                        <div class="mr-1">
                                            AKSI
                                        </div>
                                    </div>
                                </th>
                            </thead>
                            <tbody>
                                @foreach ($partners as $partner)
                                <tr class="border">
                                    <td>
                                        <div class="flex mb-2 items-center px-6 py-3">
                                            <div style="font-weight: 400; max-width: 264px;" class="text-[16px] text-gray-500">
                                                <div style="font-weight: 600;" class="text-[16px] text-black truncate">
                                                    {{ $partner->name }}
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="flex gap-2">
                                            <div style="background-color: rgb(250 204 21 / var(--tw-bg-opacity));" @click="formPartner=true" wire:click="showformPartner({{ $partner->id }})" class="px-3 py-2 rounded-lg bg-yellow-400 text-white cursor-pointer">
                                                Edit
                                            </div>
                                            <div wire:click="deletePartner({{ $partner->id }})" class="px-3 py-2 rounded-lg bg-red-500 text-white cursor-pointer">
                                                Delete
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>


        <div x-cloak x-show="formPartner" class="bg-black bg-opacity-50 w-screen h-screen fixed top-0 left-0 z-[100] flex items-center justify-center">
            <div @click.outside="formPartner=false;$wire.clearForm()" class="w-[446px] max-h-screen lg:max-h-none bg-white flex flex-col rounded-[4px]">
                <div class="flex-none px-5 py-[18px] border-b">
                    <div class="flex items-center">
                        <div @click="formPartner=false;$wire.clearForm()" class="mr-4">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                <path d="M13.0594 12.0001L16.2563 8.80322C16.5469 8.5126 16.5469 8.03447 16.2563 7.74385C15.9656 7.45322 15.4875 7.45322 15.1969 7.74385L12 10.9407L8.80313 7.74385C8.5125 7.45322 8.03437 7.45322 7.74375 7.74385C7.59844 7.88916 7.52344 8.08135 7.52344 8.27354C7.52344 8.46572 7.59844 8.65791 7.74375 8.80322L10.9406 12.0001L7.74375 15.197C7.59844 15.3423 7.52344 15.5345 7.52344 15.7267C7.52344 15.9188 7.59844 16.111 7.74375 16.2563C8.03437 16.547 8.5125 16.547 8.80313 16.2563L12 13.0595L15.1969 16.2563C15.4875 16.547 15.9656 16.547 16.2563 16.2563C16.5469 15.9657 16.5469 15.4876 16.2563 15.197L13.0594 12.0001Z" fill="#B1B1B1"/>
                            </svg>
                        </div>
                        <div style="font-weight: 600;line-height: 20px;" class="text-[16px]">
                            Buat Partner Baru
                        </div>
                    </div>
                </div>
                <div class="flex-1 overflow-y-auto hide-scrollbar lg:max-h-[700px]">
                    <div class="px-6 py-6">
                        <div x-show="true" >
                            <div class="mb-6">
                                <div class="my-1 flex">
                                    <div style="font-weight: 400;line-height: 20px;" class="mr-1 text-[14px] text-[#6A6A75]">
                                        Nama
                                    </div>
                                    <div style="font-weight: 400;line-height: 20px;" class="text-[#FE5C5C] text-[14px]">
                                        *
                                    </div>
                                </div>
                                <div>
                                    <input wire:model.lazy="name" class="p-3 rounded-[4px] w-full h-[44px]" />
                                </div>
                                @if(isset($errorMessages['name']))
                                    <p class="relative text-sm text-red-600">{{ $errorMessages['name'][0] }}</p>
                                @endif
                            </div>

                            <div class="mb-6">
                                <div class="my-1 flex">
                                    <div style="font-weight: 400;line-height: 20px;" class="mr-1 text-[14px] text-[#6A6A75]">
                                        Gambar
                                    </div>
                                    <div style="font-weight: 400;line-height: 20px;" class="text-[#FE5C5C] text-[14px]">
                                        *
                                    </div>
                                </div>
                                <div>
                                    <input type="file" id="partner_image" wire:model.lazy="partner_image" class="hidden">
                                    <input type="file" id="showImagePartner" class="hidden image" accept="image/png, image/jpeg">
                                    @if($partner_image)
                                    <img src="{{ substr($partner_image, 0, 4) != "data" ?  asset('storage/'.$partner_image) : $partner_image }}" class="w-[100px]" alt="">
                                    @else
                                    <div class=" flex gap-2">
                                        <label for="showImagePartner" class="px-4 py-3 rounded-lg bg-green-500 text-white text-[12px] cursor-pointer">
                                            Upload new image
                                        </label>
                                    </div>
                                    @endif
                                </div>
                                @if(isset($errorMessages['partner_image']))
                                    <p class="relative text-sm text-red-600">{{ $errorMessages['partner_image'][0] }}</p>
                                @endif
                            </div>
                        </div>
                    </div>

                    <div class="sticky bottom-0 px-6 py-3 flex justify-end bg-[#F9FAFB] items-center no-select">
                        <div @click="formPartner=false;$wire.clearForm()" class="p-3 text-primary rounded-[4px] mr-[14px] cursor-pointer">
                            <div style="font-weight: 600;line-height: 20px;" class="text-[16px]">
                                Batal
                            </div>
                        </div>
                        <div wire:click="{{ $is_update ? 'updatePartner' : 'submitPartner' }}" class="p-3 bg-primary rounded-[4px] text-white cursor-pointer">
                            <div style="font-weight: 600;line-height: 20px;" class="text-[16px]">
                                Simpan
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div id="modal" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true" class="hidden fixed w-screen h-screen top-0 left-0 right-0 bottom-0" style="z-index: 200">
            <div class="absolute top-0 left-0 right-0 bottom-0 flex w-screen h-screen justify-center items-center bg-black bg-opacity-70">
                <div class="modal fade p-10 rounded-lg justify-center items-center w-[500px] h-fit bg-white" style="z-index: 200">
                    <div class="modal-dialog modal-lg" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true" class="text-[20px]">×</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <div class="img-container">
                                    <div class="row">
                                        <div class="col-md-8">
                                            <img id="image" class="w-[400px]">
                                        </div>
                                        <div class="col-md-4">
                                            <div class="preview"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="w-full flex gap-2 items-center justify-end mt-5">
                                <button type="button" style=" --tw-bg-opacity: 1;background-color: rgb(248 113 113 / var(--tw-bg-opacity)); color:white;" class="px-3 py-2 bg-red-400 rounded-lg text-white" data-dismiss="modal">Cancel</button>
                                <button type="button" style=" --tw-bg-opacity: 1;background-color: rgb(74 222 128 / var(--tw-bg-opacity)); color:white;" class="px-3 py-2 bg-green-400 rounded-lg text-white" id="crop">Crop</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <script>
            function changeToInteger(field){
                field.value = field.value.replace(/\D/g, "");
            }
        </script>
        <script src="{{ asset('src/js/scrollToTop.js') }}"></script>
        <script src="{{ asset('src/js/selectStore.js') }}"></script>
        <script src="{{ asset('src/js/cropperJS.js') }}"></script>
    </div>
</div>
