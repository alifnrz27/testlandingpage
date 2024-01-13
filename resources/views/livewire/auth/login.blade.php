@section('title', 'Sign in to your account')

<div>
    <div class="font-source-sans h-screen flex">
        <div class="lg:w-6/12 hidden md:block relative overflow-hidden">
            <div class="w-full h-screen relative bg-primary">
                <div class="absolute inset-0 bg-cover" style="background-image: url('{{ asset('src/images/backgrounds/bg-login-admin.jpeg') }}');">
                    {{-- Your content here --}}
                </div>
            </div>
        </div>
        <div class="w-full lg:w-6/12 h-full text-center bg-[#D6DADF]">
            <div class="flex items-center justify-center h-full">
                <div class=" w-[395px] bg-white p-8 rounded-sm">
                    <div class="text-center mb-8">
                        <div class="text-[32px] font-bold mb-2">
                            Admin System
                        </div>
                        <div class="text-[16px] text-gray-500">
                            Selamat datang di customer loyalty platform. masukkan username & password untuk melakukan login admin
                        </div>
                    </div>
                    <form wire:submit.prevent="authenticate">
                        <div class="mb-6">
                            <div class="relative">
                                <span class="absolute inset-y-0 left-0 flex items-center pl-3">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20" fill="none">
                                        <path d="M10 10C12.0627 10 13.75 8.31246 13.75 6.25C13.75 4.18754 12.0627 2.5 10 2.5C7.9373 2.5 6.25 4.18754 6.25 6.25C6.25 8.31246 7.9373 10 10 10ZM10 11.875C7.5157 11.875 2.5 13.1407 2.5 15.625V17.5H17.5V15.625C17.5 13.1407 12.4843 11.875 10 11.875Z" fill="#6A6A75"/>
                                    </svg>
                                </span>
                                <input wire:model.lazy="username" id="username" name="username" type="text" required placeholder="Username" autofocus autocomplete="off" style="padding-left:38px;border-radius: var(--corner-radius-corner-xs, 2px);" class="appearance-none block w-full h-12 pr-3 py-2 border focus:outline-none focus:ring-primary focus:border-third transition duration-150 ease-in-out sm:text-sm sm:leading-5 @error('username') border-red-300 text-red-900 placeholder-red-300 focus:ring-red @enderror" />
                            </div>

                            @error('username')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <div class="relative">
                                <span class="absolute inset-y-0 left-0 flex items-center pl-3">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20" fill="none">
                                        <path d="M14.6875 7.49999H13.75V5.67577C13.75 3.61718 12.1094 1.90624 10.0508 1.87499C7.96484 1.84765 6.25 3.54686 6.25 5.62499V7.49999H5.3125C4.45312 7.49999 3.75 8.20311 3.75 9.06249V16.5625C3.75 17.4219 4.45312 18.125 5.3125 18.125H14.6875C15.5469 18.125 16.25 17.4219 16.25 16.5625V9.06249C16.25 8.20311 15.5469 7.49999 14.6875 7.49999ZM10.5469 12.375V15.0625C10.5469 15.3555 10.3203 15.6094 10.0273 15.625C9.71484 15.6406 9.45312 15.3906 9.45312 15.0781V12.375C9.00391 12.1562 8.70703 11.6797 8.75391 11.1367C8.80859 10.5312 9.30469 10.0469 9.91016 10.0039C10.6406 9.95312 11.25 10.5312 11.25 11.25C11.25 11.7461 10.9648 12.1719 10.5469 12.375ZM12.6562 7.49999H7.34375V5.62499C7.34375 4.91796 7.62109 4.2539 8.125 3.74999C8.62891 3.24608 9.29297 2.96874 10 2.96874C10.707 2.96874 11.3711 3.24608 11.875 3.74999C12.3789 4.2539 12.6562 4.91796 12.6562 5.62499V7.49999Z" fill="#6A6A75"/>
                                    </svg>
                                </span>
                                <input wire:model.lazy="password" id="input-password" type="password" required placeholder="Password" style="padding-left:38px;border-radius: var(--corner-radius-corner-xs, 2px);" class="appearance-none block w-full h-12 pr-3 py-2 border focus:outline-none focus:border-third focus:ring-primary transition duration-150 ease-in-out sm:text-sm sm:leading-5 @error('password') border-red-300 text-red-900 placeholder-red-300 focus:border-red-300 focus:ring-red @enderror" />
                                <div onclick="seePassword('hide-password', 'view-password', 'input-password')" class="absolute right-4 top-3 cursor-pointer">
                                    <img src="{{asset('src/icons/hide.png')}}" id="hide-password" class="w-[20px] h-[20px]" alt="">
                                    <img src="{{asset('src/icons/view.png')}}" id="view-password" class="w-[20px] h-[20px] hidden" alt="">
                                </div>
                            </div>

                            @error('password')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mt-8">
                            <span class="block w-full">
                                <button type="submit" style="background-color:#3688EF;border-radius: var(--corner-radius-corner-xs, 2px);" class="flex justify-center w-full h-[44px] items-center px-4 py-2 text-sm font-medium text-white bg-primary border border-transparent focus:outline-none focus:ring-indigo hover:opacity-60 transition duration-150 ease-in-out">
                                    Masuk
                                </button>
                            </span>
                        </div>
                    </form>
                </div>
            </div>
        </div>

    </div>
    <script src="{{asset('src/js/seePassword.js')}}"></script>
</div>
