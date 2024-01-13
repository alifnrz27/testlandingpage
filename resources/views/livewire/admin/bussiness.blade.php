<div style="margin-top:92px" class="px-12 py-10 w-full" x-data="{
    showForm:false,
    showDetail:false,
    showDetailForm:false,
    showDetailPoint:false,
    showDetailClaims:false,
    showDetailClaim:false,
    showEditClaimConfirm:false,
    showRequestNewBussiness:false,
    showVouchers:true,
    showGifts:false,
    showPromotions:false,
    showCustomers:false,
    companyForm:true,
    branchForm:false,
    exchangeForm:false,
    nextForm: 'Lanjut',
    backForm:'Batal',
    branches: [{
            id: 1,
            name: '',
            address : '',
            province: '',
            city: '',
            subdistrict: '',
            urban_village: '',
            postal_code: '',
            username: '',
            password: '',
            passwordConfirmation:''
            }],

    openVouchers(){
        showDetailClaims=true;
        showVouchers=true;
        showGifts=false;
        showPromotions=false;
    },
    openGifts(){
        showDetailClaims=true;
        showVouchers=false;
        showGifts=true;
        showPromotions=false;
    },
    openPromotions(){
        showDetailClaims=true;
        showVouchers=false;
        showGifts=false;
        showPromotions=true;
    },
    handleClickNextForm() {
        if (this.companyForm) {
            this.$wire.validateCompany();
        } else if (this.branchForm) {
            this.validateBranch();
        } else if (this.exchangeForm) {
            this.$wire.validateExxhange();
        }
    },
     handleClickBackForm() {
        if (this.companyForm) {
            this.branchForm = false;
            this.companyForm = true;
            this.showForm = false;
            this.nextForm = 'Lanjut';
            this.backForm='Batal'
        } else if (this.branchForm) {
            this.branchForm = false;
            this.companyForm = true;
            this.nextForm = 'Lanjut';
            this.backForm='Batal'
        } else if (this.exchangeForm) {
            this.branchForm = true;
            this.exchangeForm = false;
            this.nextForm = 'Lanjut';
            this.backForm='Kembali'
        }
    },
    removeBranch(branchIndex) {
        document.getElementById('branch' + branchIndex).remove();
        const index = this.branches.findIndex(branch => branch.id === branchIndex);
        alert(index)
        console.log(this.branches)
        if (index !== -1) {
            this.branches.splice(index, 1);
        }
        this.updateBranchIds();
    },
    addBranch() {
        console.log(this.branches.length)
        console.log(this.branches)
        this.branches.push({
            id: this.branches.length + 1,
            name: '',
            address : '',
            province: '',
            city: '',
            subdistrict: '',
            urban_village: '',
            postal_code: '',
            username: '',
            password: '',
            passwordConfirmation:''
             });
    },

    updateBranchIds() {
        this.branches.forEach((branch, index) => {
            branch.id = index + 1;
        });
    },
    validateBranch(){
        this.$wire.validateBranch(this.branches)
    }
    }" x-init="
            $wire.on('nextForm', value => {
                if (companyForm) {
                    branchForm = true;
                    companyForm = false;
                    nextForm = 'Lanjut';
                    backForm='Kembali'
                } else if (branchForm) {
                    branchForm = false;
                    exchangeForm = true;
                    nextForm = 'Daftarkan';
                    backForm='Kembali'
                } else if (exchangeForm) {
                    $wire.submitForm();
                }
            });

            $wire.on('closeForm', value => {
                showForm=false
                companyForm=true;
                branchForm=false;
                exchangeForm=false;
                nextForm= 'Lanjut';
                backForm='Batal';
                    branches= [{
                        id: 1,
                        name: '',
                        address : '',
                        province: '',
                        city: '',
                        subdistrict: '',
                        urban_village: '',
                        postal_code: '',
                        username: '',
                        password: '',
                        passwordConfirmation:''
                        }];
            });

            $wire.on('showDetail', value => {
                showDetail = value;
            });
            $wire.on('showDetailClaim', value => {
                showDetailClaim = value;
                showEditClaimConfirm = false;
            });
            $wire.on('showDetailForm', value => {
                showDetailForm = value;
            });
            $wire.on('showDetailPoint', value => {
                showDetailPoint = value;
            });

        ">

        <?php
            function changeDateFormat($date){
                $dateTime = new DateTime($date);
                $formattedDate = $dateTime->format('d M Y');

                return $formattedDate;
            }

            function readableDaysLeft($endDate)
            {
                $now = now();
                $target = \Carbon\Carbon::parse($endDate);
                $daysRemaining = $target->diffInDays($now);

                if ($daysRemaining > 0) {
                    $daysText = $daysRemaining === 1 ? 'hari' : 'hari';
                    $remainingText = "{$daysRemaining} {$daysText}";
                } elseif ($daysRemaining === 0) {
                    $remainingText = "Hari ini";
                } else {
                    $remainingText = "Telah berlalu";
                }

                return $remainingText;
            }
        ?>
    <div>
        <div class="lg:flex justify-between items-center w-full mb-10">
            <div class="w-full lg:w-[490px] md:w-[430px] mb-3 lg:mb-0">
                <div style="font-weight: 700;line-height: 40px;" class="flex items-center text-[32px] mb-2">
                    Bisnis Terdaftar
                </div>
                <div style="font-weight: 400;line-height: 20px;" class="text-[16px] text-[#6A6A75]">
                    Halaman ini berisi bisnis yang berhasil/sudah terdaftar dalam sistem. tambah maupun kelola bisnis sesuai dengan kebutuhan
                </div>
            </div>
            <div class="flex items-center">
                <div class="mr-5 w-[220px] h-[92px] p-3 border">
                    <div  class="mb-2 flex items-center">
                        <div class="mr-1">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20" fill="none">
                                <path d="M2.5 17.5H4.16667M4.16667 17.5H15.8333M4.16667 17.5V7.77333M17.5 17.5H15.8333M15.8333 17.5V7.77333M4.16667 7.77333C4.13551 7.75544 4.10494 7.73654 4.075 7.71667L3.625 7.41667C3.30688 7.20448 3.0714 6.88935 2.95806 6.52414C2.84472 6.15893 2.86041 5.76585 3.0025 5.41083L3.7475 3.5475C3.87124 3.23825 4.0848 2.97318 4.36063 2.78647C4.63647 2.59976 4.96192 2.49998 5.295 2.5H14.705C15.0381 2.49998 15.3635 2.59976 15.6394 2.78647C15.9152 2.97318 16.1288 3.23825 16.2525 3.5475L16.9975 5.41083C17.1396 5.76585 17.1553 6.15893 17.0419 6.52414C16.9286 6.88935 16.6931 7.20448 16.375 7.41667L15.925 7.71667C15.8951 7.73654 15.8645 7.75544 15.8333 7.77333M4.16667 7.77333C4.43587 7.92882 4.7432 8.00591 5.05392 7.99589C5.36464 7.98588 5.66636 7.88916 5.925 7.71667L7.5 6.66667L9.075 7.71667C9.34888 7.8994 9.67075 7.99692 10 7.99692C10.3292 7.99692 10.6511 7.8994 10.925 7.71667L12.5 6.66667L14.075 7.71667C14.3336 7.88916 14.6354 7.98588 14.9461 7.99589C15.2568 8.00591 15.5641 7.92882 15.8333 7.77333" stroke="#3688EF" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                <path d="M11.6667 17.5001V13.3334C11.6667 12.8914 11.4911 12.4675 11.1785 12.1549C10.866 11.8423 10.442 11.6667 10 11.6667C9.55798 11.6667 9.13405 11.8423 8.82149 12.1549C8.50893 12.4675 8.33334 12.8914 8.33334 13.3334V17.5001" stroke="#3688EF" stroke-width="1.5"/>
                            </svg>
                        </div>
                        <div style="font-weight: 400;line-height: 20px" class="text-[#6A6A75] text-[16px]">
                            Jumlah Bisnis
                        </div>
                    </div>
                    <div style="font-weight: 700;line-height: 40px;" class="text-[32px]">
                        {{count($companies)}}
                    </div>
                </div>

                <div class="w-[220px] h-[92px] p-3 border">
                    <div  class="mb-2 flex items-center">
                        <div class="mr-1">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                <path d="M12 13C13.6569 13 15 11.6569 15 10C15 8.34315 13.6569 7 12 7C10.3431 7 9 8.34315 9 10C9 11.6569 10.3431 13 12 13Z" stroke="#FE5C5C" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                <path d="M12 2C9.87827 2 7.84344 2.84285 6.34315 4.34315C4.84285 5.84344 4 7.87827 4 10C4 11.892 4.402 13.13 5.5 14.5L12 22L18.5 14.5C19.598 13.13 20 11.892 20 10C20 7.87827 19.1571 5.84344 17.6569 4.34315C16.1566 2.84285 14.1217 2 12 2Z" stroke="#FE5C5C" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                        </div>
                        <div style="font-weight: 400;line-height: 20px" class="text-[#6A6A75] text-[16px]">
                            Jumlah Kota
                        </div>
                    </div>
                    <div style="font-weight: 700;line-height: 40px;" class="text-[32px]">
                        3
                    </div>
                </div>
            </div>
        </div>

        <div class="lg:flex justify-between mb-6">
            <div class="flex items-center mb-3 lg:mb-0">
                <div class="relative">
                    <input wire:model="search" class="py-3 pr-3 pl-10 mr-5" placeholder="Cari Bisnis" />
                    <div class="absolute top-[15px] ml-3">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20" fill="none">
                            <path d="M17.3242 16.4141L13.1523 12.2031C13.9688 11.1797 14.4609 9.88281 14.4609 8.47266C14.4609 5.17188 11.7852 2.49609 8.48047 2.49609C5.17578 2.49609 2.5 5.17578 2.5 8.47656C2.5 11.7773 5.17578 14.4531 8.48047 14.4531C9.91016 14.4531 11.2188 13.9531 12.25 13.1172L16.3945 17.3008C16.5195 17.4336 16.6914 17.5 16.8594 17.5C17.0195 17.5 17.1797 17.4414 17.3008 17.3242C17.5586 17.0781 17.5664 16.6719 17.3242 16.4141ZM8.48047 13.168C7.22656 13.168 6.04688 12.6797 5.16016 11.793C4.27344 10.9062 3.78516 9.72656 3.78516 8.47656C3.78516 7.22266 4.27344 6.04297 5.16016 5.16016C6.04688 4.27344 7.22656 3.78516 8.48047 3.78516C9.73438 3.78516 10.9141 4.27344 11.8008 5.16016C12.6875 6.04688 13.1758 7.22656 13.1758 8.47656C13.1758 9.73047 12.6875 10.9102 11.8008 11.793C10.9141 12.6797 9.73438 13.168 8.48047 13.168Z" fill="#6A6A75"/>
                        </svg>
                    </div>
                </div>
                <div>
                    <select class="h-[49.6px]">
                        <option>
                            Semua Kota
                        </option>
                    </select>
                </div>
            </div>
            <div class="flex items-center gap-2">
                <div @click="showForm=true" class="p-3 bg-primary flex items-center cursor-pointer no-select rounded-[2px]">
                    <div class="mr-1">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20" fill="none">
                            <path d="M14.3945 9.375H10.625V5.60547C10.625 5.26172 10.3438 4.98047 10 4.98047C9.65625 4.98047 9.375 5.26172 9.375 5.60547V9.375H5.60547C5.26172 9.375 4.98047 9.65625 4.98047 10C4.98047 10.1719 5.05078 10.3281 5.16406 10.4414C5.27734 10.5547 5.43359 10.625 5.60547 10.625H9.375V14.3945C9.375 14.5664 9.44531 14.7227 9.55859 14.8359C9.67188 14.9492 9.82812 15.0195 10 15.0195C10.3438 15.0195 10.625 14.7383 10.625 14.3945V10.625H14.3945C14.7383 10.625 15.0195 10.3438 15.0195 10C15.0195 9.65625 14.7383 9.375 14.3945 9.375Z" fill="white"/>
                        </svg>
                    </div>
                    <div style="font-weight: 600;line-height: 20px;" class="text-white text-[16px]">
                        Bisnis Baru
                    </div>
                </div>
                <div wire:click="openRequestBusiness" @click="showRequestNewBussiness=true" class="p-3 bg-green-500 flex items-center cursor-pointer no-select rounded-[2px]">
                    <div style="font-weight: 600;line-height: 20px;" class="text-white text-[16px]">
                        Pendaftar Bisnis
                    </div>
                </div>
                <a href="{{ route('portofolio') }}" style="background-color: rgb(250 204 21 / var(--tw-bg-opacity));" class="p-3 bg-yellow-400 flex items-center cursor-pointer no-select rounded-[2px]">
                    <div style="font-weight: 600;line-height: 20px;" class="text-white text-[16px]">
                        Portofolio
                    </div>
                </a>
                <a href="{{ route('partner') }}" class="p-3 bg-primary flex items-center cursor-pointer no-select rounded-[2px]">
                    <div style="font-weight: 600;line-height: 20px;" class="text-white text-[16px]">
                        Partners
                    </div>
                </a>
            </div>
        </div>

        <div class="grid xl:grid-cols-4 grid-cols-4 md:grid-cols-4 gap-5">
            @foreach ($companies as $company)
            <div class="border">
                <div class="relative">
                    <div class="w-full h-[140px] flex items-center justify-center bg-[#EAEFF3] ">
                        @if($company->image_path)
                            <div style="background-image: url('{{ asset('storage/' . $company->image_path) }}');" class="w-full h-[144px] bg-cover bg-center"></div>

                        @else
                        <svg xmlns="http://www.w3.org/2000/svg" width="71" height="71" viewBox="0 0 71 71" fill="none">
                            <path d="M15.0833 62.01C13.4792 62.01 12.1054 61.4384 10.9621 60.295C9.81875 59.1517 9.24806 57.7789 9.25 56.1767V15.3433C9.25 13.7392 9.82167 12.3654 10.965 11.2221C12.1083 10.0788 13.4811 9.50807 15.0833 9.51001H55.9167C57.5208 9.51001 58.8946 10.0817 60.0379 11.225C61.1813 12.3683 61.752 13.7411 61.75 15.3433V56.1767C61.75 57.7808 61.1783 59.1546 60.035 60.2979C58.8917 61.4413 57.5189 62.012 55.9167 62.01H15.0833ZM18 50.3433H53L42.0625 35.76L33.3125 47.4267L26.75 38.6767L18 50.3433Z" fill="#D6DADF"/>
                        </svg>
                        @endif
                    </div>
                    <div class="absolute top-2 left-2 bg-white p-2 rounded-full flex items-center">
                        <div class="mr-1">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20" fill="none">
                                <path d="M10 1.875C6.89453 1.875 4.375 4.21484 4.375 7.09766C4.375 11.1602 10 18.125 10 18.125C10 18.125 15.625 11.1602 15.625 7.09766C15.625 4.21484 13.1055 1.875 10 1.875ZM10 9.33203C8.98828 9.33203 8.16797 8.51172 8.16797 7.5C8.16797 6.48828 8.98828 5.66797 10 5.66797C11.0117 5.66797 11.832 6.48828 11.832 7.5C11.832 8.51172 11.0117 9.33203 10 9.33203Z" fill="#B1B1B1"/>
                            </svg>
                        </div>
                        <div style="font-weight: 400;line-height: 20px;" class="text-[16px] text-[#6A6A75] max-w-[150px] truncate">
                            {{isset($company->stores[0]->city) ? $company->stores[0]->city : ""}}
                        </div>
                    </div>
                </div>

                <div class="p-5">
                    <div style="font-weight: 600;line-height: 24px;" class="texxt-[18px] h-12 line-clamp-2 mb-3">
                        {{$company->company_name}}
                    </div>
                    <div class="flex items-center">
                        <div class="flex items-center mr-6">
                            <div class="mr-1">
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20" fill="none">
                                    <path d="M3.14831 3.04591C2.99748 3.34591 2.92331 3.71758 2.77498 4.45925L2.27665 6.95091C2.20602 7.29064 2.20547 7.64121 2.27504 7.98116C2.3446 8.32111 2.48282 8.64328 2.68122 8.92796C2.87962 9.21264 3.13403 9.45382 3.42889 9.63676C3.72374 9.8197 4.05282 9.94054 4.396 9.99187C4.73917 10.0432 5.08921 10.024 5.42469 9.93532C5.76017 9.84668 6.07403 9.6905 6.34705 9.47635C6.62008 9.26219 6.84652 8.99457 7.01252 8.68986C7.17853 8.38516 7.28059 8.04977 7.31248 7.70425L7.37081 7.12925C7.33858 7.49527 7.38313 7.86399 7.50161 8.2118C7.62009 8.55961 7.8099 8.87885 8.05887 9.14907C8.30784 9.4193 8.6105 9.63456 8.94747 9.78107C9.28443 9.92758 9.64828 10.0021 10.0157 9.9999C10.3831 9.99769 10.7461 9.91878 11.0812 9.76821C11.4164 9.61765 11.7164 9.39876 11.9621 9.12555C12.2078 8.85235 12.3938 8.53084 12.5081 8.18163C12.6224 7.83242 12.6625 7.46319 12.6258 7.09758L12.6875 7.70425C12.7194 8.04977 12.8214 8.38516 12.9874 8.68986C13.1534 8.99457 13.3799 9.26219 13.6529 9.47635C13.9259 9.6905 14.2398 9.84668 14.5753 9.93532C14.9107 10.024 15.2608 10.0432 15.604 9.99187C15.9471 9.94054 16.2762 9.8197 16.5711 9.63676C16.8659 9.45382 17.1203 9.21264 17.3187 8.92796C17.5171 8.64328 17.6554 8.32111 17.7249 7.98116C17.7945 7.64121 17.7939 7.29064 17.7233 6.95091L17.225 4.45925C17.0766 3.71758 17.0025 3.34675 16.8516 3.04591C16.6945 2.73261 16.4732 2.45586 16.2021 2.23362C15.9311 2.01139 15.6163 1.84863 15.2783 1.75591C14.9533 1.66675 14.575 1.66675 13.8183 1.66675H6.18165C5.42498 1.66675 5.04665 1.66675 4.72165 1.75591C4.38362 1.84863 4.06886 2.01139 3.79781 2.23362C3.52676 2.45586 3.30548 2.73261 3.14831 3.04591ZM15.2233 11.2501C15.8747 11.2519 16.5155 11.0851 17.0833 10.7659V11.6667C17.0833 14.8092 17.0833 16.3809 16.1066 17.3567C15.3208 18.1434 14.15 18.2959 12.0833 18.3259V15.4167C12.0833 14.6376 12.0833 14.2484 11.9158 13.9584C11.8061 13.7684 11.6483 13.6106 11.4583 13.5009C11.1683 13.3334 10.7791 13.3334 9.99998 13.3334C9.22081 13.3334 8.83165 13.3334 8.54165 13.5009C8.35164 13.6106 8.19385 13.7684 8.08415 13.9584C7.91665 14.2484 7.91665 14.6376 7.91665 15.4167V18.3259C5.84998 18.2959 4.67915 18.1426 3.89331 17.3567C2.91664 16.3809 2.91665 14.8092 2.91665 11.6667V10.7659C3.48449 11.0851 4.12526 11.2519 4.77665 11.2501C5.73969 11.2508 6.6669 10.8849 7.36998 10.2267C8.08654 10.8868 9.02574 11.2522 9.99998 11.2501C10.9739 11.252 11.9127 10.8865 12.6291 10.2267C13.3329 10.8855 14.2611 11.2514 15.225 11.2501H15.2233Z" fill="#B1B1B1"/>
                                </svg>
                            </div>
                            <div style="font-weight: 400;line-height: 20px;" class="text-[16px] text-[#6A6A75]">
                                {{ count($company->stores) }} Cabang
                            </div>
                        </div>
                        <div class="flex items-center mr-6">
                            <div class="mr-1">
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20" fill="none">
                                    <path d="M13.1818 9.0625C14.4943 9.0625 15.5682 8.00773 15.5682 6.71875C15.5682 5.4298 14.4943 4.375 13.1818 4.375C11.8693 4.375 10.7955 5.4298 10.7955 6.71875C10.7955 8.00773 11.8693 9.0625 13.1818 9.0625ZM6.8182 9.0625C8.13066 9.0625 9.20453 8.00773 9.20453 6.71875C9.20453 5.4298 8.13066 4.375 6.8182 4.375C5.50574 4.375 4.4318 5.4298 4.4318 6.71875C4.4318 8.00773 5.50574 9.0625 6.8182 9.0625ZM6.8182 10.7812C4.94875 10.7812 1.25 11.6796 1.25 13.5156V15.625H12.5V13.5156C12.5 11.6796 8.68754 10.7812 6.8182 10.7812ZM13.1818 11.2111C12.9433 11.2111 12.7785 11.2111 12.5 11.25C13.4151 11.9141 13.75 12.3438 13.75 13.5156V15.625H18.75V13.5156C18.75 11.6796 15.0513 11.2111 13.1818 11.2111Z" fill="#B1B1B1"/>
                                </svg>
                            </div>
                            <div style="font-weight: 400;line-height: 20px;" class="text-[16px] text-[#6A6A75]">
                                {{count($company->customers())}} Customer
                            </div>
                        </div>
                    </div>
                </div>

                <div class="p-5">
                    <div class="flex items-center mb-3">
                        <div class="mr-1 w-5 h-5 flex items-center justify-center bg-[#E5EDFA] rounded-full">
                            <svg xmlns="http://www.w3.org/2000/svg" width="10" height="10" viewBox="0 0 10 10" fill="none">
                                <path d="M8.74998 2.08325H1.24998C1.13947 2.08325 1.03349 2.12715 0.955352 2.20529C0.877212 2.28343 0.833313 2.38941 0.833313 2.49992V4.16659H1.2054C1.6204 4.16659 2.0054 4.45034 2.07206 4.85992C2.09237 4.97952 2.08634 5.10211 2.05438 5.21913C2.02243 5.33616 1.96532 5.4448 1.88704 5.53748C1.80876 5.63016 1.71121 5.70464 1.60117 5.75572C1.49114 5.80681 1.37129 5.83327 1.24998 5.83325H0.833313V7.49992C0.833313 7.61043 0.877212 7.71641 0.955352 7.79455C1.03349 7.87269 1.13947 7.91659 1.24998 7.91659H8.74998C8.86049 7.91659 8.96647 7.87269 9.04461 7.79455C9.12275 7.71641 9.16665 7.61043 9.16665 7.49992V5.83325H8.74998C8.62867 5.83327 8.50881 5.80681 8.39878 5.75572C8.28875 5.70464 8.1912 5.63016 8.11292 5.53748C8.03464 5.4448 7.97753 5.33616 7.94558 5.21913C7.91362 5.10211 7.90759 4.97952 7.9279 4.85992C7.99456 4.45034 8.37956 4.16659 8.79456 4.16659H9.16665V2.49992C9.16665 2.38941 9.12275 2.28343 9.04461 2.20529C8.96647 2.12715 8.86049 2.08325 8.74998 2.08325ZM4.58331 7.08325H3.74998V6.24992H4.58331V7.08325ZM4.58331 5.41659H3.74998V4.58325H4.58331V5.41659ZM4.58331 3.74992H3.74998V2.91659H4.58331V3.74992Z" fill="#3688EF"/>
                            </svg>
                        </div>
                        <div style="font-weight: 400;line-height: 20px;" class="text-[16px] text-[#6A6A75]">
                            {{count($company->vouchers)}} Voucher
                        </div>
                    </div>
                    <div class="flex items-center mb-3">
                        <div class="mr-1 w-5 h-5 flex items-center justify-center bg-[#FAE4E4] rounded-full">
                            <svg xmlns="http://www.w3.org/2000/svg" width="10" height="10" viewBox="0 0 10 10" fill="none">
                                <g clip-path="url(#clip0_552_7785)">
                                    <path d="M3.77502 0.804216C2.98752 0.80005 2.22085 1.55838 2.57085 2.50005H1.25002C1.02901 2.50005 0.817045 2.58785 0.660765 2.74413C0.504484 2.90041 0.416687 3.11237 0.416687 3.33338V4.16672C0.416687 4.27722 0.460586 4.3832 0.538726 4.46134C0.616866 4.53948 0.722847 4.58338 0.833354 4.58338H4.58335V3.33338H5.41669V4.58338H9.16669C9.27719 4.58338 9.38318 4.53948 9.46132 4.46134C9.53946 4.3832 9.58335 4.27722 9.58335 4.16672V3.33338C9.58335 3.11237 9.49556 2.90041 9.33928 2.74413C9.183 2.58785 8.97103 2.50005 8.75002 2.50005H7.42919C7.91669 1.13755 6.08335 0.17505 5.23752 1.35005L5.00002 1.66672L4.76252 1.34172C4.50002 0.970883 4.13752 0.808383 3.77502 0.804216ZM3.75002 1.66672C4.12085 1.66672 4.30835 2.11672 4.04585 2.37922C3.78335 2.64172 3.33335 2.45422 3.33335 2.08338C3.33335 1.97288 3.37725 1.8669 3.45539 1.78876C3.53353 1.71062 3.63951 1.66672 3.75002 1.66672ZM6.25002 1.66672C6.62085 1.66672 6.80835 2.11672 6.54585 2.37922C6.28335 2.64172 5.83335 2.45422 5.83335 2.08338C5.83335 1.97288 5.87725 1.8669 5.95539 1.78876C6.03353 1.71062 6.13951 1.66672 6.25002 1.66672ZM0.833354 5.00005V8.33338C0.833354 8.5544 0.921151 8.76636 1.07743 8.92264C1.23371 9.07892 1.44567 9.16672 1.66669 9.16672H8.33335C8.55437 9.16672 8.76633 9.07892 8.92261 8.92264C9.07889 8.76636 9.16669 8.5544 9.16669 8.33338V5.00005H5.41669V8.33338H4.58335V5.00005H0.833354Z" fill="#FE5C5C"/>
                                </g>
                                <defs>
                                    <clipPath id="clip0_552_7785">
                                        <rect width="10" height="10" fill="white"/>
                                    </clipPath>
                                </defs>
                            </svg>
                        </div>
                        <div style="font-weight: 400;line-height: 20px;" class="text-[16px] text-[#6A6A75]">
                            {{count($company->gifts)}} Hadiah
                        </div>
                    </div>
                    <div class="flex items-center">
                        <div class="mr-1 w-5 h-5 flex items-center justify-center bg-[#DDF1E2] rounded-full">
                            <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 12 12" fill="none">
                                <path fill-rule="evenodd" clip-rule="evenodd" d="M4.88251 1.49891C5.0232 1.34179 5.19545 1.21609 5.388 1.13004C5.58056 1.04399 5.7891 0.999512 6.00001 0.999512C6.21092 0.999512 6.41946 1.04399 6.61202 1.13004C6.80458 1.21609 6.97682 1.34179 7.11751 1.49891L7.46751 1.88991C7.51753 1.94587 7.5795 1.98984 7.64883 2.01858C7.71816 2.04732 7.79308 2.06008 7.86801 2.05591L8.39301 2.02691C8.60354 2.01535 8.81413 2.0483 9.01107 2.12361C9.208 2.19893 9.38684 2.31491 9.53593 2.464C9.68502 2.61309 9.801 2.79193 9.87631 2.98886C9.95162 3.18579 9.98457 3.39639 9.97301 3.60691L9.94401 4.13192C9.93993 4.20677 9.95272 4.28158 9.98146 4.35082C10.0102 4.42006 10.0541 4.48195 10.11 4.53192L10.5015 4.88192C10.6587 5.02261 10.7845 5.19488 10.8706 5.38749C10.9567 5.58009 11.0012 5.78869 11.0012 5.99967C11.0012 6.21064 10.9567 6.41924 10.8706 6.61184C10.7845 6.80445 10.6587 6.97672 10.5015 7.11741L10.11 7.46742C10.0541 7.51743 10.0101 7.57941 9.98135 7.64874C9.95261 7.71807 9.93985 7.79298 9.94401 7.86792L9.97301 8.39291C9.98457 8.60344 9.95162 8.81404 9.87631 9.01097C9.801 9.2079 9.68502 9.38674 9.53593 9.53583C9.38684 9.68492 9.208 9.8009 9.01107 9.87621C8.81413 9.95153 8.60354 9.98448 8.39301 9.97291L7.86801 9.94392C7.79316 9.93983 7.71834 9.95263 7.64911 9.98136C7.57987 10.0101 7.51798 10.054 7.46801 10.1099L7.11801 10.5014C6.97732 10.6586 6.80504 10.7844 6.61244 10.8705C6.41984 10.9566 6.21124 11.0011 6.00026 11.0011C5.78929 11.0011 5.58069 10.9566 5.38808 10.8705C5.19548 10.7844 5.0232 10.6586 4.88251 10.5014L4.53251 10.1099C4.48249 10.054 4.42052 10.01 4.35119 9.98125C4.28186 9.95251 4.20695 9.93975 4.13201 9.94392L3.60701 9.97291C3.39649 9.98448 3.18589 9.95153 2.98896 9.87621C2.79202 9.8009 2.61318 9.68492 2.46409 9.53583C2.31501 9.38674 2.19902 9.2079 2.12371 9.01097C2.0484 8.81404 2.01545 8.60344 2.02701 8.39291L2.05601 7.86792C2.0601 7.79306 2.0473 7.71825 2.01857 7.64901C1.98983 7.57977 1.9459 7.51788 1.89001 7.46792L1.49901 7.11792C1.3418 6.97722 1.21604 6.80495 1.12994 6.61234C1.04383 6.41974 0.999329 6.21114 0.999329 6.00016C0.999329 5.78919 1.04383 5.58059 1.12994 5.38799C1.21604 5.19538 1.3418 5.02311 1.49901 4.88242L1.89001 4.53241C1.94596 4.4824 1.98994 4.42042 2.01868 4.35109C2.04741 4.28176 2.06017 4.20685 2.05601 4.13192L2.02701 3.60691C2.01545 3.39639 2.0484 3.18579 2.12371 2.98886C2.19902 2.79193 2.31501 2.61309 2.46409 2.464C2.61318 2.31491 2.79202 2.19893 2.98896 2.12361C3.18589 2.0483 3.39649 2.01535 3.60701 2.02691L4.13201 2.05591C4.20686 2.06 4.28168 2.0472 4.35092 2.01847C4.42015 1.98974 4.48205 1.9458 4.53201 1.88991L4.88201 1.49891H4.88251ZM7.85351 4.14642C7.94725 4.24018 7.9999 4.36733 7.9999 4.49992C7.9999 4.6325 7.94725 4.75965 7.85351 4.85342L4.85351 7.85342C4.75921 7.94449 4.63291 7.99489 4.50181 7.99375C4.37071 7.99261 4.24531 7.94003 4.1526 7.84732C4.0599 7.75462 4.00731 7.62921 4.00617 7.49812C4.00504 7.36702 4.05543 7.24072 4.14651 7.14642L7.14651 4.14642C7.24027 4.05268 7.36743 4.00002 7.50001 4.00002C7.63259 4.00002 7.75975 4.05268 7.85351 4.14642ZM4.75001 3.99992C4.5511 3.99992 4.36033 4.07893 4.21968 4.21958C4.07903 4.36024 4.00001 4.551 4.00001 4.74992V4.75492C4.00001 4.95383 4.07903 5.14459 4.21968 5.28525C4.36033 5.4259 4.5511 5.50492 4.75001 5.50492H4.75501C4.95392 5.50492 5.14469 5.4259 5.28534 5.28525C5.42599 5.14459 5.50501 4.95383 5.50501 4.75492V4.74992C5.50501 4.551 5.42599 4.36024 5.28534 4.21958C5.14469 4.07893 4.95392 3.99992 4.75501 3.99992H4.75001ZM7.25001 6.49992C7.0511 6.49992 6.86033 6.57893 6.71968 6.71958C6.57903 6.86024 6.50001 7.051 6.50001 7.24992V7.25492C6.50001 7.45383 6.57903 7.64459 6.71968 7.78525C6.86033 7.9259 7.0511 8.00492 7.25001 8.00492H7.25501C7.45392 8.00492 7.64469 7.9259 7.78534 7.78525C7.92599 7.64459 8.00501 7.45383 8.00501 7.25492V7.24992C8.00501 7.051 7.92599 6.86024 7.78534 6.71958C7.64469 6.57893 7.45392 6.49992 7.25501 6.49992H7.25001Z" fill="#2C9854"/>
                            </svg>
                        </div>
                        <div style="font-weight: 400;line-height: 20px;" class="text-[16px] text-[#6A6A75]">
                            {{count($company->promotions)}} Promo
                        </div>
                    </div>
                </div>

                <div class="px-5 pb-5">
                    <div wire:click="detailCompany({{$company->id}})" style="font-weight: 600;line-height: 20px;" class="w-full border p-3 flex items-center justify-center text-primary text-[16px] cursor-pointer no-select">
                        Lihat Detail
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>

    <div x-cloak x-show="showForm" class="bg-black bg-opacity-50 w-screen h-screen fixed top-0 left-0 z-[100] flex items-center justify-center">
        <div @click.outside="showForm=false" class="w-[446px] max-h-screen lg:max-h-none bg-white flex flex-col rounded-[4px]">
            <div class="flex-none px-5 py-[18px] border-b">
                <div class="flex items-center no-select">
                    <div @click="showForm=false" class="mr-4 cursor-pointer">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                            <path d="M13.0594 12.0001L16.2563 8.80322C16.5469 8.5126 16.5469 8.03447 16.2563 7.74385C15.9656 7.45322 15.4875 7.45322 15.1969 7.74385L12 10.9407L8.80313 7.74385C8.5125 7.45322 8.03437 7.45322 7.74375 7.74385C7.59844 7.88916 7.52344 8.08135 7.52344 8.27354C7.52344 8.46572 7.59844 8.65791 7.74375 8.80322L10.9406 12.0001L7.74375 15.197C7.59844 15.3423 7.52344 15.5345 7.52344 15.7267C7.52344 15.9188 7.59844 16.111 7.74375 16.2563C8.03437 16.547 8.5125 16.547 8.80313 16.2563L12 13.0595L15.1969 16.2563C15.4875 16.547 15.9656 16.547 16.2563 16.2563C16.5469 15.9657 16.5469 15.4876 16.2563 15.197L13.0594 12.0001Z" fill="#B1B1B1"/>
                        </svg>
                    </div>
                    <div style="font-weight: 600;line-height: 20px;" class="text-[16px]">
                        Buat Bisnis Baru
                    </div>
                </div>
            </div>
            <div class="flex-1 overflow-y-auto hide-scrollbar lg:max-h-[700px]">
                <div class="px-6 py-6 mb-[68px]">
                    <div class="no-select mb-8">
                        <div class="flex justify-between items-center mb-1">
                            <div :class="companyForm ? 'bg-[#E5EDFA] border-primary' : branchForm || exchangeForm ? 'border-[#D6DADF] bg-primary' : '' " class="border-2 rounded-full p-2">
                                <div x-show="companyForm" style="font-weight: 600;line-height: 20px;" class="w-5 h-5 flex items-center justify-center text-[16px]">
                                    1
                                </div>
                                <svg x-show="!companyForm" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                    <path d="M16.9969 9.04214L16.1719 8.1937C16.1391 8.1562 16.0875 8.13745 16.0407 8.13745C15.9891 8.13745 15.9422 8.1562 15.9094 8.1937L10.1907 13.9546L8.10942 11.8734C8.07192 11.8359 8.02505 11.8171 7.97817 11.8171C7.9313 11.8171 7.88442 11.8359 7.84692 11.8734L7.01255 12.7078C6.93755 12.7828 6.93755 12.9 7.01255 12.975L9.63755 15.6C9.8063 15.7687 10.0125 15.8671 10.186 15.8671C10.4344 15.8671 10.65 15.6843 10.7297 15.6093H10.7344L17.0016 9.30933C17.0672 9.22964 17.0672 9.11245 16.9969 9.04214Z" fill="white"/>
                                </svg>
                            </div>
                            <div class="w-[92.5px] bg-[#EDEDED] h-[2px]">
                            </div>
                            <div :class="companyForm ? 'border-[#D6DADF] bg-[#ffffff]' : branchForm ? 'border-[#D6DADF] bg-[#E5EDFAs]' : exchangeForm ? 'border-[#D6DADF] bg-primary' : '' " class="border-2 border-primary rounded-full p-2">
                                <div x-show="branchForm || companyForm" style="font-weight: 600;line-height: 20px;" class="w-5 h-5 flex items-center justify-center text-[16px]">
                                    2
                                </div>
                                <svg x-show="exchangeForm" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                    <path d="M16.9969 9.04214L16.1719 8.1937C16.1391 8.1562 16.0875 8.13745 16.0407 8.13745C15.9891 8.13745 15.9422 8.1562 15.9094 8.1937L10.1907 13.9546L8.10942 11.8734C8.07192 11.8359 8.02505 11.8171 7.97817 11.8171C7.9313 11.8171 7.88442 11.8359 7.84692 11.8734L7.01255 12.7078C6.93755 12.7828 6.93755 12.9 7.01255 12.975L9.63755 15.6C9.8063 15.7687 10.0125 15.8671 10.186 15.8671C10.4344 15.8671 10.65 15.6843 10.7297 15.6093H10.7344L17.0016 9.30933C17.0672 9.22964 17.0672 9.11245 16.9969 9.04214Z" fill="white"/>
                                </svg>
                            </div>
                            <div class="w-[92.5px] bg-[#EDEDED] h-[2px]">
                            </div>
                            <div :class="exchangeForm ? 'bg-[#E5EDFA] border-primary' : branchForm || companyForm ? 'border-[#D6DADF] bg-[#FFFFFF]' : '' "  class="border-2 border-primary rounded-full p-2">
                                <div style="font-weight: 600;line-height: 20px;" class="w-5 h-5 flex items-center justify-center text-[16px]">
                                    3
                                </div>
                            </div>
                        </div>
                        <div class="flex justify-between">
                            <div style="font-weight: 600;line-height: 20px;" class="text-[16px] w-[100px] flex justify-start items-center">
                                Perusahaan
                            </div>
                            <div style="font-weight: 600;line-height: 20px;" :class="companyForm ? 'text-[#B1B1B1]' : branchForm ? 'text-dark-primary' : exchangeForm ? 'text-dark-primary' : '' " class="text-[16px] w-[100px] flex justify-center items-center">
                                Cabang
                            </div>
                            <div style="font-weight: 600;line-height: 20px;" :class="companyForm || branchForm ? 'text-[#B1B1B1]' : 'text-dark-primary'" class="text-[16px] w-[100px] flex justify-end items-center">
                                Penukaran
                            </div>
                        </div>
                    </div>

                    <div x-show="companyForm">
                        <div class="flex justify-center items-center" x-data="{
                                deleteImage(){
                                    const thumbnailContainer = document.getElementById('thumbnailUploadContainer');
                                    const imageInput = document.getElementById('imageInput');
                                    let thumbnailImage = null;
                                    imageInput.click();
                                },
                                addImage(){
                                    const imageInput = document.getElementById('imageInput');
                                    imageInput.click();
                                }
                                }">
                            <div @click="addImage()" class="relative w-[85px] h-[85px] flex items-center justify-center bg-[#EDEDED] rounded-full no-select cursor-pointer mb-6">
                                <input wire:model="image_path" id="imageInput" type="file" class="hidden" />
                                <div class="relative flex items-center justify-center">
                                    @if ($image_path)
                                        <img src="{{ is_string($image_path) ?  asset('storage/'.$image_path) : $image_path->temporaryUrl() }}" class= "w-[85px] h-[85px] rounded-full" alt="Uploaded Image">
                                        <div wire:click="removeImage" @click="deleteImage()" class="absolute items-start p-1 top-0 right-0 text-white cursor-pointer rounded-full bg-black opacity-50">
                                            <div class="w-2 h-2 flex items-center justify-center">
                                                x
                                            </div>
                                        </div>
                                    @else
                                    <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" viewBox="0 0 29 28" fill="none">
                                        <path d="M14.375 7.6999C14.375 9.37077 13.7113 10.9732 12.5298 12.1547C11.3483 13.3362 9.74589 13.9999 8.07502 13.9999C6.40416 13.9999 4.80173 13.3362 3.62025 12.1547C2.43877 10.9732 1.77502 9.37077 1.77502 7.6999C1.77502 6.02904 2.43877 4.42661 3.62025 3.24513C4.80173 2.06365 6.40416 1.3999 8.07502 1.3999C9.74589 1.3999 11.3483 2.06365 12.5298 3.24513C13.7113 4.42661 14.375 6.02904 14.375 7.6999ZM8.77502 4.8999C8.77502 4.71425 8.70127 4.5362 8.57 4.40493C8.43872 4.27365 8.26068 4.1999 8.07502 4.1999C7.88937 4.1999 7.71133 4.27365 7.58005 4.40493C7.44877 4.5362 7.37502 4.71425 7.37502 4.8999V6.9999H5.27502C5.08937 6.9999 4.91133 7.07365 4.78005 7.20493C4.64877 7.3362 4.57502 7.51425 4.57502 7.6999C4.57502 7.88555 4.64877 8.0636 4.78005 8.19488C4.91133 8.32615 5.08937 8.3999 5.27502 8.3999H7.37502V10.4999C7.37502 10.6856 7.44877 10.8636 7.58005 10.9949C7.71133 11.1262 7.88937 11.1999 8.07502 11.1999C8.26068 11.1999 8.43872 11.1262 8.57 10.9949C8.70127 10.8636 8.77502 10.6856 8.77502 10.4999V8.3999H10.875C11.0607 8.3999 11.2387 8.32615 11.37 8.19488C11.5013 8.0636 11.575 7.88555 11.575 7.6999C11.575 7.51425 11.5013 7.3362 11.37 7.20493C11.2387 7.07365 11.0607 6.9999 10.875 6.9999H8.77502V4.8999ZM8.07502 15.3999C9.39302 15.4001 10.689 15.0621 11.8389 14.4181C12.9889 13.774 13.9543 12.8456 14.6427 11.7217C15.3311 10.5978 15.7195 9.31597 15.7706 7.99897C15.8218 6.68197 15.5341 5.37387 14.935 4.1999H19.975C21.0889 4.1999 22.1572 4.6424 22.9449 5.43005C23.7325 6.21771 24.175 7.28599 24.175 8.3999V19.5999C24.175 20.5099 23.8866 21.3499 23.3952 22.0387L15.8492 14.6075C15.4564 14.2206 14.9271 14.0038 14.3757 14.0038C13.8243 14.0038 13.2951 14.2206 12.9022 14.6075L5.35622 22.0387C4.84711 21.3275 4.57388 20.4745 4.57502 19.5999V14.5599C5.62502 15.0975 6.81502 15.3999 8.07502 15.3999ZM17.875 11.1999C18.0607 11.1999 18.2387 11.1262 18.37 10.9949C18.5013 10.8636 18.575 10.6856 18.575 10.4999C18.575 10.3143 18.5013 10.1362 18.37 10.0049C18.2387 9.87365 18.0607 9.7999 17.875 9.7999C17.6894 9.7999 17.5113 9.87365 17.3801 10.0049C17.2488 10.1362 17.175 10.3143 17.175 10.4999C17.175 10.6856 17.2488 10.8636 17.3801 10.9949C17.5113 11.1262 17.6894 11.1999 17.875 11.1999ZM17.875 12.5999C18.432 12.5999 18.9661 12.3787 19.36 11.9848C19.7538 11.591 19.975 11.0569 19.975 10.4999C19.975 9.94295 19.7538 9.4088 19.36 9.01498C18.9661 8.62115 18.432 8.3999 17.875 8.3999C17.3181 8.3999 16.7839 8.62115 16.3901 9.01498C15.9963 9.4088 15.775 9.94295 15.775 10.4999C15.775 11.0569 15.9963 11.591 16.3901 11.9848C16.7839 12.3787 17.3181 12.5999 17.875 12.5999ZM6.34602 23.0271C7.03202 23.5143 7.87063 23.7999 8.77502 23.7999H19.975C20.8794 23.7999 21.718 23.5143 22.404 23.0271L14.8664 15.6071C14.7355 15.478 14.5589 15.4056 14.375 15.4056C14.1911 15.4056 14.0146 15.478 13.8836 15.6071L6.34602 23.0271Z" fill="#B1B1B1"/>
                                    </svg>
                                    @endif
                                </div>
                                <div class="absolute w-6 h-6 flex items-center justify-center bottom-[7.75px] right-0 bg-primary rounded-full">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="17" height="17" viewBox="0 0 17 17" fill="none">
                                        <path d="M13.625 8.9169H9.29166V13.2502H7.95834V8.9169H3.625V7.58359H7.95834V3.25024H9.29166V7.58359H13.625V8.9169Z" fill="white"/>
                                    </svg>
                                </div>
                            </div>
                        </div>
                        @if(isset($errorMessages['image_path']))
                            <p class="relative text-sm text-red-600 -mt-4">{{ $errorMessages['image_path'][0] }}</p>
                        @endif

                        <div class="mb-6">
                            <div class="my-1 flex">
                                <div style="font-weight: 400;line-height: 20px;" class="mr-1 text-[14px] text-[#6A6A75]">
                                    Nama Bisnis
                                </div>
                                <div style="font-weight: 400;line-height: 20px;" class="text-[#FE5C5C] text-[14px]">
                                    *
                                </div>
                            </div>
                            <div>
                                <input wire:model="company_name" class="p-3 rounded-[4px] w-full h-[44px]" />
                            </div>
                            @if(isset($errorMessages['company_name']))
                                <p class="relative text-sm text-red-600">{{ $errorMessages['company_name'][0] }}</p>
                            @endif
                        </div>

                        <div class="mb-6">
                            <div class="my-1 flex">
                                <div style="font-weight: 400;line-height: 20px;" class="mr-1 text-[14px] text-[#6A6A75]">
                                    Nama Domain
                                </div>
                                <div style="font-weight: 400;line-height: 20px;" class="text-[#FE5C5C] text-[14px]">
                                    *
                                </div>
                            </div>
                            <div>
                                <input wire:model="subdomain" class="p-3 rounded-[4px] w-full h-[44px]" />
                            </div>
                            @if(isset($errorMessages['subdomain']))
                                <p class="relative text-sm text-red-600">{{ $errorMessages['subdomain'][0] }}</p>
                            @endif
                        </div>

                        <div class="mb-6">
                            <div class="my-1 flex">
                                <div style="font-weight: 400;line-height: 20px;" class="mr-1 text-[14px] text-[#6A6A75]">
                                    Aktif Hingga
                                </div>
                                <div style="font-weight: 400;line-height: 20px;" class="text-[#FE5C5C] text-[14px]">
                                    *
                                </div>
                            </div>
                            <div>
                                <input wire:model="expired_date" type="date" class="p-3 rounded-[4px] w-full h-[44px]" />
                            </div>
                            @if(isset($errorMessages['expired_date']))
                                <p class="relative text-sm text-red-600">{{ $errorMessages['expired_date'][0] }}</p>
                            @endif
                        </div>

                        <div class="mb-6">
                            <div class="my-1 flex">
                                <div style="font-weight: 400;line-height: 20px;" class="mr-1 text-[14px] text-[#6A6A75]">
                                    Username
                                </div>
                                <div style="font-weight: 400;line-height: 20px;" class="text-[#FE5C5C] text-[14px]">
                                    *
                                </div>
                            </div>
                            <div>
                                <input wire:model="username" class="p-3 rounded-[4px] w-full h-[44px]" />
                            </div>
                            @if(isset($errorMessages['username']))
                                <p class="relative text-sm text-red-600">{{ $errorMessages['username'][0] }}</p>
                            @endif
                        </div>

                        <div class="mb-6">
                            <div class="my-1 flex">
                                <div style="font-weight: 400;line-height: 20px;" class="mr-1 text-[14px] text-[#6A6A75]">
                                    Password
                                </div>
                                <div style="font-weight: 400;line-height: 20px;" class="text-[#FE5C5C] text-[14px]">
                                    *
                                </div>
                            </div>
                            <div>
                                <input wire:model="password" type="password" class="p-3 rounded-[4px] w-full h-[44px]" />
                            </div>
                            @if(isset($errorMessages['password']))
                                <p class="relative text-sm text-red-600">{{ $errorMessages['password'][0] }}</p>
                            @endif
                        </div>

                        <div class="mb-6">
                            <div class="my-1 flex">
                                <div style="font-weight: 400;line-height: 20px;" class="mr-1 text-[14px] text-[#6A6A75]">
                                    Konfirmasi Password
                                </div>
                                <div style="font-weight: 400;line-height: 20px;" class="text-[#FE5C5C] text-[14px]">
                                    *
                                </div>
                            </div>
                            <div>
                                <input wire:model="passwordConfirmation" type="password" class="p-3 rounded-[4px] w-full h-[44px]" />
                            </div>
                        </div>
                    </div>

                    <div x-show="branchForm">
                        <div class="mb-8">
                            <template x-for="(branch, index) in branches">
                                <div :id="'branch' + branch.id" class="p-[16px] border border-[#EDEDED] mb-3">
                                    <div class="flex justify-between items-center mb-6">
                                        <div style="font-weight: 600;line-height: 24px;" class="text-[18px] " x-text="'Cabang ' + (index+1)">
                                        </div>
                                        <div @click="removeBranch(branch.id)" x-show="index > 0" class="no-select cursor-pointer">
                                            X
                                        </div>
                                    </div>
                                    <div class="mb-6">
                                        <div class="my-1 flex">
                                            <div style="font-weight: 400;line-height: 20px;" class="mr-1 text-[14px] text-[#6A6A75]">
                                                Nama Cabang
                                            </div>
                                            <div style="font-weight: 400;line-height: 20px;" class="text-[#FE5C5C] text-[14px]">
                                                *
                                            </div>
                                        </div>
                                        <div>
                                            <input x-model="branch.name" class="p-3 rounded-[4px] w-full h-[44px]" />
                                        </div>
                                    </div>
                                    <div class="mb-6">
                                        <div class="my-1 flex">
                                            <div style="font-weight: 400;line-height: 20px;" class="mr-1 text-[14px] text-[#6A6A75]">
                                                Alamat
                                            </div>
                                            <div style="font-weight: 400;line-height: 20px;" class="text-[#FE5C5C] text-[14px]">
                                                *
                                            </div>
                                        </div>
                                        <div>
                                            <input x-model="branch.address" class="p-3 rounded-[4px] w-full h-[44px]" />
                                        </div>
                                    </div>
                                    <div class="flex gap-5 mb-6">
                                        <div class="w-6/12">
                                            <div class="my-1 flex">
                                                <div style="font-weight: 400;line-height: 20px;" class="mr-1 text-[14px] text-[#6A6A75]">
                                                    Provinsi
                                                </div>
                                                <div style="font-weight: 400;line-height: 20px;" class="text-[#FE5C5C] text-[14px]">
                                                    *
                                                </div>
                                            </div>
                                            <div>
                                                <input x-model="branch.province" class="p-3 rounded-[4px] w-full h-[44px]" />
                                            </div>
                                        </div>
                                        <div class="w-6/12">
                                            <div class="my-1 flex">
                                                <div style="font-weight: 400;line-height: 20px;" class="mr-1 text-[14px] text-[#6A6A75]">
                                                    Kota
                                                </div>
                                                <div style="font-weight: 400;line-height: 20px;" class="text-[#FE5C5C] text-[14px]">
                                                    *
                                                </div>
                                            </div>
                                            <div>
                                                <input x-model="branch.city" class="p-3 rounded-[4px] w-full h-[44px]" />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="flex gap-5 mb-6">
                                        <div class="w-6/12">
                                            <div class="my-1 flex">
                                                <div style="font-weight: 400;line-height: 20px;" class="mr-1 text-[14px] text-[#6A6A75]">
                                                    Kecamatan
                                                </div>
                                                <div style="font-weight: 400;line-height: 20px;" class="text-[#FE5C5C] text-[14px]">
                                                    *
                                                </div>
                                            </div>
                                            <div>
                                                <input x-model="branch.subdistrict" class="p-3 rounded-[4px] w-full h-[44px]" />
                                            </div>
                                        </div>
                                        <div class="w-6/12">
                                            <div class="my-1 flex">
                                                <div style="font-weight: 400;line-height: 20px;" class="mr-1 text-[14px] text-[#6A6A75]">
                                                    Kelurahan
                                                </div>
                                                <div style="font-weight: 400;line-height: 20px;" class="text-[#FE5C5C] text-[14px]">
                                                    *
                                                </div>
                                            </div>
                                            <div>
                                                <input x-model="branch.urban_village" class="p-3 rounded-[4px] w-full h-[44px]" />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="mb-6">
                                        <div class="my-1 flex">
                                            <div style="font-weight: 400;line-height: 20px;" class="mr-1 text-[14px] text-[#6A6A75]">
                                                Kode Pos
                                            </div>
                                            <div style="font-weight: 400;line-height: 20px;" class="text-[#FE5C5C] text-[14px]">
                                                *
                                            </div>
                                        </div>
                                        <div>
                                            <input x-model="branch.postal_code" class="p-3 rounded-[4px] w-full h-[44px]" />
                                        </div>
                                    </div>
                                    <div class="mb-6">
                                        <div class="my-1 flex">
                                            <div style="font-weight: 400;line-height: 20px;" class="mr-1 text-[14px] text-[#6A6A75]">
                                                Username
                                            </div>
                                            <div style="font-weight: 400;line-height: 20px;" class="text-[#FE5C5C] text-[14px]">
                                                *
                                            </div>
                                        </div>
                                        <div>
                                            <input x-model="branch.username" class="p-3 rounded-[4px] w-full h-[44px]" />
                                        </div>
                                    </div>
                                    <div class="mb-6">
                                        <div class="my-1 flex">
                                            <div style="font-weight: 400;line-height: 20px;" class="mr-1 text-[14px] text-[#6A6A75]">
                                                Password
                                            </div>
                                            <div style="font-weight: 400;line-height: 20px;" class="text-[#FE5C5C] text-[14px]">
                                                *
                                            </div>
                                        </div>
                                        <div>
                                            <input x-model="branch.password" type="password" class="p-3 rounded-[4px] w-full h-[44px]" />
                                        </div>
                                    </div>
                                    <div class="">
                                        <div class="my-1 flex">
                                            <div style="font-weight: 400;line-height: 20px;" class="mr-1 text-[14px] text-[#6A6A75]">
                                                Konfirmasi Passowrd
                                            </div>
                                            <div style="font-weight: 400;line-height: 20px;" class="text-[#FE5C5C] text-[14px]">
                                                *
                                            </div>
                                        </div>
                                        <div>
                                            <input x-model="branch.passwordConfirmation" type="password" class="p-3 rounded-[4px] w-full h-[44px]" />
                                        </div>
                                    </div>
                                </div>
                            </template>
                        </div>

                        <div id="tombol" class="p-3 flex items-center no-select">
                            <div class="flex items-center justify-center cursor-pointer" @click="addBranch">
                                <div class="mr-1">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20" fill="none">
                                        <path d="M14.3945 9.375H10.625V5.60547C10.625 5.26172 10.3438 4.98047 10 4.98047C9.65625 4.98047 9.375 5.26172 9.375 5.60547V9.375H5.60547C5.26172 9.375 4.98047 9.65625 4.98047 10C4.98047 10.1719 5.05078 10.3281 5.16406 10.4414C5.27734 10.5547 5.43359 10.625 5.60547 10.625H9.375V14.3945C9.375 14.5664 9.44531 14.7227 9.55859 14.8359C9.67188 14.9492 9.82812 15.0195 10 15.0195C10.3438 15.0195 10.625 14.7383 10.625 14.3945V10.625H14.3945C14.7383 10.625 15.0195 10.3438 15.0195 10C15.0195 9.65625 14.7383 9.375 14.3945 9.375Z" fill="#3688EF"/>
                                    </svg>
                                </div>
                                <div style="font-weight: 600;line-height: 20px;" class="text-primary text-[16px]">
                                    Tambah Cabang
                                </div>
                            </div>
                        </div>
                    </div>

                    <div x-show="exchangeForm" >
                        <div class="py-8">
                            <div class="mb-4">
                                <div style="font-weight: 600;line-height: 24px;" class="text-[20px] flex justify-center mb-2">
                                    Sistem  Penukaran Poin
                                </div>
                                <div style="font-weight: 400;line-height: 20px;" class="text-[16px] text-[#6A6A75] text-center">
                                    Poin akan diperoleh customer melalui kelipatan belanja tertentu. Sepakati & tentukan konversinya dengan pemilik bisnis
                                </div>
                            </div>

                            <div class="relative mb-3">
                                <input onclick="selectAllText(this)" oninput="formatRupiah(this)" wire:model="total_shopping" class="py-3 pr-3 pl-10 h-[44px] rounded-sm w-full" placeholder="Jumlah belanja" />
                                <div class="absolute p-1 top-[6px] pl-3">
                                    Rp
                                </div>
                                @if(isset($errorMessages['total_shopping']))
                                    <p class="relative text-sm text-red-600">{{ $errorMessages['total_shopping'][0] }}</p>
                                @endif
                            </div>

                            <div class="flex justify-center mb-3">
                                <div class="p-2 border border-[#D6DADF] rounded-full flex items-center justify-center bg-[#F5F7F9]">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                        <path d="M11.5174 18.2296C11.7518 17.9906 12.1408 17.9859 12.3799 18.2249L14.6252 20.4374L14.6252 9.89058C14.6252 9.55307 14.8971 9.2812 15.2346 9.2812C15.5721 9.2812 15.8439 9.55307 15.8439 9.89058L15.8439 20.4328L18.0893 18.2203C18.3283 17.9859 18.7127 17.9859 18.9518 18.2249C19.1861 18.464 19.1861 18.8484 18.9471 19.0875L15.6658 22.3218C15.6096 22.3734 15.5486 22.4203 15.4736 22.4484C15.3986 22.4812 15.3189 22.4953 15.2393 22.4953C15.0799 22.4953 14.9299 22.4343 14.8127 22.3218L11.5314 19.0874C11.2877 18.8531 11.283 18.4687 11.5174 18.2296ZM5.04863 5.77026C5.283 6.00933 5.67207 6.01401 5.91113 5.77495L8.15644 3.56714L8.15644 14.1093C8.15644 14.4468 8.42832 14.7187 8.76582 14.7187C9.10331 14.7187 9.37519 14.4468 9.37519 14.1093L9.37519 3.56714L11.6205 5.77964C11.8596 6.01401 12.2439 6.01401 12.483 5.77495C12.7174 5.53589 12.7174 5.15151 12.4783 4.91245L9.19707 1.67808C9.14082 1.62651 9.07988 1.57964 9.00488 1.55151C8.92988 1.5187 8.85019 1.50464 8.7705 1.50464C8.61113 1.50464 8.46113 1.56558 8.34394 1.67808L5.06269 4.91245C4.81894 5.14683 4.81425 5.5312 5.04863 5.77026Z" fill="#B1B1B1"/>
                                    </svg>
                                </div>
                            </div>

                            <div class="relative">
                                <input onclick="selectAllText(this)" oninput="onlyNumber(this)" wire:model="point" class="py-3 pr-3 pl-10 h-[44px] rounded-sm w-full" placeholder="Poin diperoleh" />
                                <div class="absolute p-1 top-[11px] pl-3">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 14 14" fill="none">
                                        <path d="M7.00277 12.8351C3.78102 12.8351 1.16943 10.2235 1.16943 7.00179C1.16943 3.78004 3.78102 1.16846 7.00277 1.16846C10.2245 1.16846 12.8361 3.78004 12.8361 7.00179C12.8361 10.2235 10.2245 12.8351 7.00277 12.8351ZM7.00277 4.52671L4.52768 7.00179L7.00277 9.47687L9.47727 7.00179L7.00277 4.52671Z" fill="#FFA858"/>
                                        <path fill-rule="evenodd" clip-rule="evenodd" d="M7.00282 3.7017L10.3021 7.00179L7.00282 10.3019L3.70273 7.00179L7.00282 3.7017ZM1.75277 7.00179C1.75277 9.90137 4.10318 12.2518 7.00277 12.2518C9.90235 12.2518 12.2528 9.90137 12.2528 7.00179C12.2528 4.10221 9.90235 1.75179 7.00277 1.75179C4.10318 1.75179 1.75277 4.10221 1.75277 7.00179ZM4.52768 7.00179L7.00277 4.52671L9.47727 7.00179L7.00277 9.47687L4.52768 7.00179ZM1.16943 7.00179C1.16943 10.2235 3.78102 12.8351 7.00277 12.8351C10.2245 12.8351 12.8361 10.2235 12.8361 7.00179C12.8361 3.78004 10.2245 1.16846 7.00277 1.16846C3.78102 1.16846 1.16943 3.78004 1.16943 7.00179Z" fill="#DF812B"/>
                                    </svg>
                                </div>
                                @if(isset($errorMessages['point']))
                                    <p class="relative text-sm text-red-600">{{ $errorMessages['point'][0] }}</p>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>

                <div class="sticky bottom-0 px-6 py-3 flex justify-end bg-[#F9FAFB] items-center no-select">
                    <div :class="branchForm || exchangeForm ? 'border bg-white' : ''" class="p-3 text-primary rounded-[4px] mr-[14px] cursor-pointer">
                        <div @click="handleClickBackForm" style="font-weight: 600;line-height: 20px;" class="text-[16px]" x-text="backForm">
                            {{--  Batal  --}}
                        </div>
                    </div>
                    <div @click="handleClickNextForm" class="p-3 bg-primary rounded-[4px] text-white cursor-pointer">
                        <div style="font-weight: 600;line-height: 20px;" class="text-[16px]" x-text="nextForm">
                            {{--  Lanjut  --}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div x-cloak x-show="showRequestNewBussiness" class="bg-[#D6DADF] w-screen min-h-screen fixed top-0 left-0 flex mt-[92.8px] justify-center">
        <div class="mt-8 w-[662px] flex flex-col">
            <div class="flex-none">
                <div class="flex items-center mb-4">
                    <div @click="showRequestNewBussiness=false" wire:click="resetForm" class="no-select cursor-pointer flex items-center">
                        <div class="mr-1">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20" fill="none">
                                <path d="M8.45312 6.39459C8.65234 6.5899 8.65234 6.91412 8.45703 7.11334L6.08594 9.49224H15.1211C15.3984 9.49224 15.625 9.71881 15.625 10.0001C15.625 10.2813 15.3984 10.5079 15.1211 10.5079H6.08594L8.46094 12.8868C8.65625 13.086 8.65234 13.4063 8.45703 13.6055C8.25781 13.8008 7.94141 13.8008 7.74219 13.6016L4.52344 10.3594C4.48047 10.3126 4.44531 10.2618 4.41797 10.1993C4.39062 10.1368 4.37891 10.0704 4.37891 10.004C4.37891 9.87115 4.42969 9.74615 4.52344 9.64849L7.74219 6.40631C7.93359 6.20318 8.25391 6.19928 8.45312 6.39459Z" fill="#3688EF"/>
                            </svg>
                        </div>
                        <div style="font-weight: 600;line-height: 20px;" class="text-primary text-[16px]">
                            Kembali ke Daftar Bisnis
                        </div>
                    </div>
                </div>
            </div>

            <div class="w-full flex-1 bg-white rounded-sm overflow-auto max-h-[600px] hide-scrollbar">
                <div class="p-6">
                    <div class="mb-6">
                        <div style="font-weight: 600;line-height: 24px;" class="text-[20px] mb-3">
                            Daftar Pengguna Request Website
                        </div>

                        @foreach($request_website as $index => $user)
                        <div class="mb-5">
                            <div class="flex justify-between items-center bg-gray-200 px-3 py-2 rounded-lg">
                                <div>
                                    <div class="text-[20px] font-bold">
                                        {{ $user->name }}
                                    </div>
                                    <div class="text-[12px]">
                                        {{ $user->email }}
                                    </div>
                                    <div class="text-[12px]">
                                        {{ $user->phone_number }}
                                    </div>
                                    <div class="text-[12px]">
                                        Referal : {{ $user->referal ? $user->referal->name : "-" }}
                                    </div>
                                </div>
                                <div wire:click="acceptRequestBusiness({{ $user->id }})" class="px-3 py-2 flex items-center justify-self-center cursor-pointer text-white bg-green-500 rounded-lg">
                                    Accept
                                </div>
                            </div>
                        </div>

                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div x-cloak x-show="showDetail" class="bg-[#D6DADF] w-screen min-h-screen fixed top-0 left-0 flex mt-[92.8px] justify-center">
        <div class="mt-8 w-[662px] flex flex-col">
            <div class="flex-none">
                <div class="flex items-center mb-4">
                    <div @click="showDetail=false" wire:click="resetForm" class="no-select cursor-pointer flex items-center">
                        <div class="mr-1">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20" fill="none">
                                <path d="M8.45312 6.39459C8.65234 6.5899 8.65234 6.91412 8.45703 7.11334L6.08594 9.49224H15.1211C15.3984 9.49224 15.625 9.71881 15.625 10.0001C15.625 10.2813 15.3984 10.5079 15.1211 10.5079H6.08594L8.46094 12.8868C8.65625 13.086 8.65234 13.4063 8.45703 13.6055C8.25781 13.8008 7.94141 13.8008 7.74219 13.6016L4.52344 10.3594C4.48047 10.3126 4.44531 10.2618 4.41797 10.1993C4.39062 10.1368 4.37891 10.0704 4.37891 10.004C4.37891 9.87115 4.42969 9.74615 4.52344 9.64849L7.74219 6.40631C7.93359 6.20318 8.25391 6.19928 8.45312 6.39459Z" fill="#3688EF"/>
                            </svg>
                        </div>
                        <div style="font-weight: 600;line-height: 20px;" class="text-primary text-[16px]">
                            Kembali ke Daftar Bisnis
                        </div>
                    </div>
                </div>
            </div>

            <div class="w-full flex-1 bg-white rounded-sm overflow-auto max-h-[600px] hide-scrollbar">
                <div class="flex justify-between border-b">
                    <div class="p-5 border-b gap-5 flex justify-between items-center">
                        <div class="relative flex items-center justify-center border border-[#EDEDED] rounded-full w-[85px] h-[85px] bg-[#F5F7F9]">
                            <div>
                                <svg xmlns="http://www.w3.org/2000/svg" width="25" height="24" viewBox="0 0 25 24" fill="none">
                                    <path d="M21.5 19V5.00002C21.5 3.89991 20.6001 3 19.5 3H5.50002C4.39991 3 3.5 3.89991 3.5 5.00002V19C3.5 20.1001 4.39991 21 5.50002 21H19.5C20.6001 21 21.5 20.1001 21.5 19ZM8.99998 13.5L11.5 16.5L15 12L19.5 18H5.50002L8.99998 13.5Z" fill="#D6DADF"/>
                                </svg>
                            </div>
                            <div class="px-2 py-1 flex items-center gap-1 absolute -bottom-1 bg-white border rounded-full">
                                <div class="w-[6px] h-[6px] bg-[#2C9854] rounded-full">
                                </div>
                                <div style="font-weight: 400;line-height: 20px;" class="text-[14px] truncate">
                                    {{$status ? 'Aktif' : 'Tidak Aktif'}}
                                </div>
                            </div>
                        </div>

                        <div class="max-w-[413px]">
                            <div style="font-weight: 700;line-height: 32px;" class="text-[24px] mb-1 truncate">
                                {{$company_name}}
                            </div>
                            <div class="flex gap-3 items-center">
                                <div @click="showDetailPoint=true" class="px-3 py-2 bg-[#F5F7F9] rounded-full flex items-center gap-1 no-select cursor-pointer">
                                    <div>
                                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="21" viewBox="0 0 20 21" fill="none">
                                            <path d="M10.0042 18.8356C5.40167 18.8356 1.67084 15.1048 1.67084 10.5023C1.67084 5.89978 5.40167 2.16895 10.0042 2.16895C14.6067 2.16895 18.3375 5.89978 18.3375 10.5023C18.3375 15.1048 14.6067 18.8356 10.0042 18.8356ZM10.0042 6.96644L6.46834 10.5023L10.0042 14.0381L13.5392 10.5023L10.0042 6.96644Z" fill="#FFA858"/>
                                            <path fill-rule="evenodd" clip-rule="evenodd" d="M10.0041 5.78835L14.7175 10.5028L10.0041 15.2172L5.28973 10.5028L10.0041 5.78835ZM2.50408 10.5028C2.50408 14.645 5.86182 18.0028 10.0041 18.0028C14.1463 18.0028 17.5041 14.645 17.5041 10.5028C17.5041 6.3605 14.1463 3.00277 10.0041 3.00277C5.86182 3.00277 2.50408 6.3605 2.50408 10.5028ZM6.46825 10.5028L10.0041 6.96693L13.5391 10.5028L10.0041 14.0386L6.46825 10.5028ZM1.67075 10.5028C1.67075 15.1053 5.40158 18.8361 10.0041 18.8361C14.6066 18.8361 18.3374 15.1053 18.3374 10.5028C18.3374 5.90027 14.6066 2.16943 10.0041 2.16943C5.40158 2.16943 1.67075 5.90027 1.67075 10.5028Z" fill="#DF812B"/>
                                        </svg>
                                    </div>
                                    <div style="font-weight: 400;line-height: 20px;" class="text-[14px]">
                                        Rp {{$total_shopping}} / {{$point}} Point
                                    </div>
                                </div>
                                <div @click="showCustomers=true" class="px-3 py-2 bg-[#F5F7F9] rounded-full flex items-center gap-1 cursor-pointer no-select">
                                    <div>
                                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="21" viewBox="0 0 20 21" fill="none">
                                            <path d="M13.1818 9.5625C14.4943 9.5625 15.5682 8.50773 15.5682 7.21875C15.5682 5.9298 14.4943 4.875 13.1818 4.875C11.8693 4.875 10.7955 5.9298 10.7955 7.21875C10.7955 8.50773 11.8693 9.5625 13.1818 9.5625ZM6.8182 9.5625C8.13066 9.5625 9.20453 8.50773 9.20453 7.21875C9.20453 5.9298 8.13066 4.875 6.8182 4.875C5.50574 4.875 4.4318 5.9298 4.4318 7.21875C4.4318 8.50773 5.50574 9.5625 6.8182 9.5625ZM6.8182 11.2812C4.94875 11.2812 1.25 12.1796 1.25 14.0156V16.125H12.5V14.0156C12.5 12.1796 8.68754 11.2812 6.8182 11.2812ZM13.1818 11.7111C12.9433 11.7111 12.7785 11.7111 12.5 11.75C13.4151 12.4141 13.75 12.8438 13.75 14.0156V16.125H18.75V14.0156C18.75 12.1796 15.0513 11.7111 13.1818 11.7111Z" fill="#6A6A75"/>
                                        </svg>
                                    </div>
                                    <div style="font-weight: 400;line-height: 20px;" class="text-[14px]">
                                        {{ $detailCompany ? count($detailCompany->customers()) : 'No' }} Customer
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div @click="showDetailForm=true" class="p-3 flex items-center gap-1 cursor-pointer no-select">
                        <div>
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="21" viewBox="0 0 20 21" fill="none">
                                <path d="M2.5 15.0501V17.5834C2.5 17.8167 2.68333 18.0001 2.91667 18.0001H5.45C5.55833 18.0001 5.66667 17.9584 5.74167 17.8751L14.8417 8.78342L11.7167 5.65842L2.625 14.7501C2.54167 14.8334 2.5 14.9334 2.5 15.0501ZM17.2583 6.36675C17.3356 6.28966 17.3969 6.19808 17.4387 6.09727C17.4805 5.99646 17.502 5.88839 17.502 5.77925C17.502 5.67011 17.4805 5.56204 17.4387 5.46123C17.3969 5.36042 17.3356 5.26885 17.2583 5.19175L15.3083 3.24175C15.2312 3.1645 15.1397 3.10321 15.0389 3.06139C14.938 3.01957 14.83 2.99805 14.7208 2.99805C14.6117 2.99805 14.5036 3.01957 14.4028 3.06139C14.302 3.10321 14.2104 3.1645 14.1333 3.24175L12.6083 4.76675L15.7333 7.89175L17.2583 6.36675Z" fill="#3688EF"/>
                            </svg>
                        </div>
                        <div style="font-weight: 600;line-height: 20px;" class="text-primary text-[16px]">
                            Ubah
                        </div>
                    </div>
                </div>
                <div class="p-6">
                    <div class="mb-6">
                        <div style="font-weight: 600;line-height: 24px;" class="text-[20px] mb-3">
                            Penawaran
                        </div>
                        <div class="flex gap-5">
                            <div class="w-4/12 border rounded-sm p-3">
                                <div class="mb-2 flex items-center gap-1">
                                    <div class="w-6 h-6 flex items-center justify-center bg-[#E5EDFA] rounded-full">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 10 10" fill="none">
                                            <path d="M8.74998 2.08325H1.24998C1.13947 2.08325 1.03349 2.12715 0.955352 2.20529C0.877212 2.28343 0.833313 2.38941 0.833313 2.49992V4.16659H1.2054C1.6204 4.16659 2.0054 4.45034 2.07206 4.85992C2.09237 4.97952 2.08634 5.10211 2.05438 5.21913C2.02243 5.33616 1.96532 5.4448 1.88704 5.53748C1.80876 5.63016 1.71121 5.70464 1.60117 5.75572C1.49114 5.80681 1.37129 5.83327 1.24998 5.83325H0.833313V7.49992C0.833313 7.61043 0.877212 7.71641 0.955352 7.79455C1.03349 7.87269 1.13947 7.91659 1.24998 7.91659H8.74998C8.86049 7.91659 8.96647 7.87269 9.04461 7.79455C9.12275 7.71641 9.16665 7.61043 9.16665 7.49992V5.83325H8.74998C8.62867 5.83327 8.50881 5.80681 8.39878 5.75572C8.28875 5.70464 8.1912 5.63016 8.11292 5.53748C8.03464 5.4448 7.97753 5.33616 7.94558 5.21913C7.91362 5.10211 7.90759 4.97952 7.9279 4.85992C7.99456 4.45034 8.37956 4.16659 8.79456 4.16659H9.16665V2.49992C9.16665 2.38941 9.12275 2.28343 9.04461 2.20529C8.96647 2.12715 8.86049 2.08325 8.74998 2.08325ZM4.58331 7.08325H3.74998V6.24992H4.58331V7.08325ZM4.58331 5.41659H3.74998V4.58325H4.58331V5.41659ZM4.58331 3.74992H3.74998V2.91659H4.58331V3.74992Z" fill="#3688EF"/>
                                        </svg>
                                    </div>
                                    <div style="font-weight: 400;line-height: 20px;" class="text-[16px] text-[#6A6A75]">
                                        Voucher
                                    </div>
                                </div>
                                <div style="font-weight: 700;line-height: 40px;" class="text-[32px] mb-2">
                                    {{$detailCompany ? count($detailCompany->vouchers) : "0"}}
                                </div>
                                <div style="font-weight: 600;line-height: 20px;" class="py-3 text-primary text-[16px] flex items-center">
                                    <div @click="showDetailClaims=true;showVouchers=true;showGifts=false;showPromotions=false;" class=" cursor-pointer no-select">
                                        Lihat
                                    </div>
                                </div>
                            </div>
                            <div class="w-4/12 border rounded-sm p-3">
                                <div class="mb-2 flex items-center gap-1">
                                    <div class="w-6 h-6 flex items-center justify-center bg-[#FAE4E4] rounded-full">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 10 10" fill="none">
                                            <g clip-path="url(#clip0_552_7785)">
                                                <path d="M3.77502 0.804216C2.98752 0.80005 2.22085 1.55838 2.57085 2.50005H1.25002C1.02901 2.50005 0.817045 2.58785 0.660765 2.74413C0.504484 2.90041 0.416687 3.11237 0.416687 3.33338V4.16672C0.416687 4.27722 0.460586 4.3832 0.538726 4.46134C0.616866 4.53948 0.722847 4.58338 0.833354 4.58338H4.58335V3.33338H5.41669V4.58338H9.16669C9.27719 4.58338 9.38318 4.53948 9.46132 4.46134C9.53946 4.3832 9.58335 4.27722 9.58335 4.16672V3.33338C9.58335 3.11237 9.49556 2.90041 9.33928 2.74413C9.183 2.58785 8.97103 2.50005 8.75002 2.50005H7.42919C7.91669 1.13755 6.08335 0.17505 5.23752 1.35005L5.00002 1.66672L4.76252 1.34172C4.50002 0.970883 4.13752 0.808383 3.77502 0.804216ZM3.75002 1.66672C4.12085 1.66672 4.30835 2.11672 4.04585 2.37922C3.78335 2.64172 3.33335 2.45422 3.33335 2.08338C3.33335 1.97288 3.37725 1.8669 3.45539 1.78876C3.53353 1.71062 3.63951 1.66672 3.75002 1.66672ZM6.25002 1.66672C6.62085 1.66672 6.80835 2.11672 6.54585 2.37922C6.28335 2.64172 5.83335 2.45422 5.83335 2.08338C5.83335 1.97288 5.87725 1.8669 5.95539 1.78876C6.03353 1.71062 6.13951 1.66672 6.25002 1.66672ZM0.833354 5.00005V8.33338C0.833354 8.5544 0.921151 8.76636 1.07743 8.92264C1.23371 9.07892 1.44567 9.16672 1.66669 9.16672H8.33335C8.55437 9.16672 8.76633 9.07892 8.92261 8.92264C9.07889 8.76636 9.16669 8.5544 9.16669 8.33338V5.00005H5.41669V8.33338H4.58335V5.00005H0.833354Z" fill="#FE5C5C"/>
                                            </g>
                                            <defs>
                                                <clipPath id="clip0_552_7785">
                                                <rect width="10" height="10" fill="white"/>
                                                </clipPath>
                                            </defs>
                                        </svg>
                                    </div>
                                    <div style="font-weight: 400;line-height: 20px;" class="text-[16px] text-[#6A6A75]">
                                        Hadiah
                                    </div>
                                </div>
                                <div style="font-weight: 700;line-height: 40px;" class="text-[32px] mb-2">
                                    {{$detailCompany ? count($detailCompany->gifts) : "0"}}
                                </div>
                                <div style="font-weight: 600;line-height: 20px;" class="py-3 text-primary text-[16px] flex items-center">
                                    <div @click="showDetailClaims=true;showVouchers=false;showGifts=true;showPromotions=false;" class=" cursor-pointer no-select">
                                        Lihat
                                    </div>
                                </div>
                            </div>
                            <div class="w-4/12 border rounded-sm p-3">
                                <div class="mb-2 flex items-center gap-1">
                                    <div class="w-6 h-6 flex items-center justify-center bg-[#DDF1E2] rounded-full">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 12 12" fill="none">
                                            <path fill-rule="evenodd" clip-rule="evenodd" d="M4.88251 1.49891C5.0232 1.34179 5.19545 1.21609 5.388 1.13004C5.58056 1.04399 5.7891 0.999512 6.00001 0.999512C6.21092 0.999512 6.41946 1.04399 6.61202 1.13004C6.80458 1.21609 6.97682 1.34179 7.11751 1.49891L7.46751 1.88991C7.51753 1.94587 7.5795 1.98984 7.64883 2.01858C7.71816 2.04732 7.79308 2.06008 7.86801 2.05591L8.39301 2.02691C8.60354 2.01535 8.81413 2.0483 9.01107 2.12361C9.208 2.19893 9.38684 2.31491 9.53593 2.464C9.68502 2.61309 9.801 2.79193 9.87631 2.98886C9.95162 3.18579 9.98457 3.39639 9.97301 3.60691L9.94401 4.13192C9.93993 4.20677 9.95272 4.28158 9.98146 4.35082C10.0102 4.42006 10.0541 4.48195 10.11 4.53192L10.5015 4.88192C10.6587 5.02261 10.7845 5.19488 10.8706 5.38749C10.9567 5.58009 11.0012 5.78869 11.0012 5.99967C11.0012 6.21064 10.9567 6.41924 10.8706 6.61184C10.7845 6.80445 10.6587 6.97672 10.5015 7.11741L10.11 7.46742C10.0541 7.51743 10.0101 7.57941 9.98135 7.64874C9.95261 7.71807 9.93985 7.79298 9.94401 7.86792L9.97301 8.39291C9.98457 8.60344 9.95162 8.81404 9.87631 9.01097C9.801 9.2079 9.68502 9.38674 9.53593 9.53583C9.38684 9.68492 9.208 9.8009 9.01107 9.87621C8.81413 9.95153 8.60354 9.98448 8.39301 9.97291L7.86801 9.94392C7.79316 9.93983 7.71834 9.95263 7.64911 9.98136C7.57987 10.0101 7.51798 10.054 7.46801 10.1099L7.11801 10.5014C6.97732 10.6586 6.80504 10.7844 6.61244 10.8705C6.41984 10.9566 6.21124 11.0011 6.00026 11.0011C5.78929 11.0011 5.58069 10.9566 5.38808 10.8705C5.19548 10.7844 5.0232 10.6586 4.88251 10.5014L4.53251 10.1099C4.48249 10.054 4.42052 10.01 4.35119 9.98125C4.28186 9.95251 4.20695 9.93975 4.13201 9.94392L3.60701 9.97291C3.39649 9.98448 3.18589 9.95153 2.98896 9.87621C2.79202 9.8009 2.61318 9.68492 2.46409 9.53583C2.31501 9.38674 2.19902 9.2079 2.12371 9.01097C2.0484 8.81404 2.01545 8.60344 2.02701 8.39291L2.05601 7.86792C2.0601 7.79306 2.0473 7.71825 2.01857 7.64901C1.98983 7.57977 1.9459 7.51788 1.89001 7.46792L1.49901 7.11792C1.3418 6.97722 1.21604 6.80495 1.12994 6.61234C1.04383 6.41974 0.999329 6.21114 0.999329 6.00016C0.999329 5.78919 1.04383 5.58059 1.12994 5.38799C1.21604 5.19538 1.3418 5.02311 1.49901 4.88242L1.89001 4.53241C1.94596 4.4824 1.98994 4.42042 2.01868 4.35109C2.04741 4.28176 2.06017 4.20685 2.05601 4.13192L2.02701 3.60691C2.01545 3.39639 2.0484 3.18579 2.12371 2.98886C2.19902 2.79193 2.31501 2.61309 2.46409 2.464C2.61318 2.31491 2.79202 2.19893 2.98896 2.12361C3.18589 2.0483 3.39649 2.01535 3.60701 2.02691L4.13201 2.05591C4.20686 2.06 4.28168 2.0472 4.35092 2.01847C4.42015 1.98974 4.48205 1.9458 4.53201 1.88991L4.88201 1.49891H4.88251ZM7.85351 4.14642C7.94725 4.24018 7.9999 4.36733 7.9999 4.49992C7.9999 4.6325 7.94725 4.75965 7.85351 4.85342L4.85351 7.85342C4.75921 7.94449 4.63291 7.99489 4.50181 7.99375C4.37071 7.99261 4.24531 7.94003 4.1526 7.84732C4.0599 7.75462 4.00731 7.62921 4.00617 7.49812C4.00504 7.36702 4.05543 7.24072 4.14651 7.14642L7.14651 4.14642C7.24027 4.05268 7.36743 4.00002 7.50001 4.00002C7.63259 4.00002 7.75975 4.05268 7.85351 4.14642ZM4.75001 3.99992C4.5511 3.99992 4.36033 4.07893 4.21968 4.21958C4.07903 4.36024 4.00001 4.551 4.00001 4.74992V4.75492C4.00001 4.95383 4.07903 5.14459 4.21968 5.28525C4.36033 5.4259 4.5511 5.50492 4.75001 5.50492H4.75501C4.95392 5.50492 5.14469 5.4259 5.28534 5.28525C5.42599 5.14459 5.50501 4.95383 5.50501 4.75492V4.74992C5.50501 4.551 5.42599 4.36024 5.28534 4.21958C5.14469 4.07893 4.95392 3.99992 4.75501 3.99992H4.75001ZM7.25001 6.49992C7.0511 6.49992 6.86033 6.57893 6.71968 6.71958C6.57903 6.86024 6.50001 7.051 6.50001 7.24992V7.25492C6.50001 7.45383 6.57903 7.64459 6.71968 7.78525C6.86033 7.9259 7.0511 8.00492 7.25001 8.00492H7.25501C7.45392 8.00492 7.64469 7.9259 7.78534 7.78525C7.92599 7.64459 8.00501 7.45383 8.00501 7.25492V7.24992C8.00501 7.051 7.92599 6.86024 7.78534 6.71958C7.64469 6.57893 7.45392 6.49992 7.25501 6.49992H7.25001Z" fill="#2C9854"/>
                                        </svg>
                                    </div>
                                    <div style="font-weight: 400;line-height: 20px;" class="text-[16px] text-[#6A6A75]">
                                        Promo
                                    </div>
                                </div>
                                <div style="font-weight: 700;line-height: 40px;" class="text-[32px] mb-2">
                                    {{$detailCompany ? count($detailCompany->promotions) : "0"}}
                                </div>
                                <div style="font-weight: 600;line-height: 20px;" class="py-3 text-primary text-[16px] flex items-center">
                                    <div  @click="showDetailClaims=true;showVouchers=false;showGifts=false;showPromotions=true;" class=" cursor-pointer no-select">
                                        Lihat
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div>
                        <div style="font-weight: 600;line-height: 24px;" class="text-[20px] mb-3">
                            Cabang
                        </div>
                        @if($detailCompany)
                        @foreach ($detailCompany->stores as $store)
                        <div class="flex justify-between p-5 border-b">
                            <div class="flex gap-2">
                                <div>
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                        <path d="M15.75 4.50019C15.7499 3.79065 15.5486 3.09568 15.1693 2.49601C14.79 1.89634 14.2484 1.41658 13.6074 1.11245C12.9663 0.808312 12.2521 0.692291 11.5478 0.777859C10.8434 0.863427 10.1778 1.14707 9.62818 1.59585C9.07859 2.04462 8.66759 2.64011 8.44293 3.31315C8.21828 3.98619 8.18917 4.70915 8.359 5.39807C8.52884 6.08699 8.89063 6.71358 9.40237 7.20508C9.91411 7.69659 10.5548 8.03282 11.25 8.17472V21.4483C11.2501 21.6476 11.2898 21.8448 11.3667 22.0286L11.8388 23.1536C11.8546 23.1826 11.8779 23.2067 11.9063 23.2236C11.9346 23.2404 11.967 23.2493 12 23.2493C12.033 23.2493 12.0654 23.2404 12.0937 23.2236C12.1221 23.2067 12.1454 23.1826 12.1613 23.1536L12.6333 22.0286C12.7102 21.8448 12.7499 21.6476 12.75 21.4483V8.17472C13.5964 8.00078 14.357 7.54032 14.9035 6.87096C15.4499 6.20161 15.7489 5.3643 15.75 4.50019ZM13.125 4.50019C12.9025 4.50019 12.685 4.43421 12.5 4.3106C12.315 4.18698 12.1708 4.01128 12.0856 3.80571C12.0005 3.60015 11.9782 3.37395 12.0216 3.15572C12.065 2.93749 12.1722 2.73703 12.3295 2.5797C12.4868 2.42236 12.6873 2.31522 12.9055 2.27181C13.1238 2.2284 13.35 2.25068 13.5555 2.33583C13.7611 2.42098 13.9368 2.56517 14.0604 2.75018C14.184 2.93518 14.25 3.15269 14.25 3.37519C14.25 3.67356 14.1315 3.95971 13.9205 4.17069C13.7095 4.38167 13.4234 4.50019 13.125 4.50019Z" fill="#FE5C5C"/>
                                    </svg>
                                </div>
                                <div class="max-w-[450px]">
                                    <div style="font-weight: 600;line-height: 20px;" class="mb-2 text-[16px] truncate">
                                        {{$store->name}}
                                    </div>
                                    <div style="font-weight: 400;line-height: 20px" class="text-[14px] text-[#6A6A75] truncate" >
                                        {{$store->address}}, {{$store->urban_village}}, {{$store->subdistrict}}, {{$store->city}}, {{$store->province}} ({{$store->postal_code}})
                                    </div>
                                </div>
                            </div>
                            <div wire:click="changeStatusStore({{$store->id}})" class="flex h-5 w-[41px] cursor-pointer items-center rounded-full p-1 {{ $store->status_by_admin ? 'bg-primary' : 'bg-gray-400'}}">
                                <div class="toggle-circle h-4 w-4 rounded-full bg-white {{ $store->status_by_admin ? 'translate-x-4' : ''}} transition duration-300 ease-in-out">
                                </div>
                            </div>
                        </div>
                        @endforeach
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div x-cloak x-show="showDetailForm" class="bg-black bg-opacity-50 w-screen h-screen fixed top-0 left-0 z-[100] flex items-center justify-center">
        <div @click.outside="showDetailForm=false" class="w-[446px] max-h-screen lg:max-h-none     bg-white flex flex-col rounded-[4px]">
            <div class="flex-none px-5 py-[18px] border-b">
                <div class="flex items-center">
                    <div @click="showDetailForm=false" class="mr-4 cursor-pointer">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                            <path d="M13.0594 12.0001L16.2563 8.80322C16.5469 8.5126 16.5469 8.03447 16.2563 7.74385C15.9656 7.45322 15.4875 7.45322 15.1969 7.74385L12 10.9407L8.80313 7.74385C8.5125 7.45322 8.03437 7.45322 7.74375 7.74385C7.59844 7.88916 7.52344 8.08135 7.52344 8.27354C7.52344 8.46572 7.59844 8.65791 7.74375 8.80322L10.9406 12.0001L7.74375 15.197C7.59844 15.3423 7.52344 15.5345 7.52344 15.7267C7.52344 15.9188 7.59844 16.111 7.74375 16.2563C8.03437 16.547 8.5125 16.547 8.80313 16.2563L12 13.0595L15.1969 16.2563C15.4875 16.547 15.9656 16.547 16.2563 16.2563C16.5469 15.9657 16.5469 15.4876 16.2563 15.197L13.0594 12.0001Z" fill="#B1B1B1"/>
                        </svg>
                    </div>
                    <div style="font-weight: 600;line-height: 20px;" class="text-[16px]">
                        Update Bisnis
                    </div>
                </div>
            </div>
            <div class="flex-1 overflow-y-auto hide-scrollbar lg:max-h-[700px]">
                <div class="px-6 py-6">
                    <div x-show="true" >
                        <div class="mb-6">
                            <div class="my-1 flex">
                                <div style="font-weight: 400;line-height: 20px;" class="mr-1 text-[14px] text-[#6A6A75]">
                                    Nama Bisnis
                                </div>
                                <div style="font-weight: 400;line-height: 20px;" class="text-[#FE5C5C] text-[14px]">
                                    *
                                </div>
                            </div>
                            <div>
                                <input wire:model="company_name" class="p-3 rounded-[4px] w-full h-[44px]" />
                            </div>
                            @if(isset($errorMessages['company_name']))
                                <p class="relative text-sm text-red-600">{{ $errorMessages['company_name'][0] }}</p>
                            @endif
                        </div>

                        <div class="mb-6">
                            <div class="my-1 flex">
                                <div style="font-weight: 400;line-height: 20px;" class="mr-1 text-[14px] text-[#6A6A75]">
                                    Nama Domain
                                </div>
                                <div style="font-weight: 400;line-height: 20px;" class="text-[#FE5C5C] text-[14px]">
                                    *
                                </div>
                            </div>
                            <div>
                                <input wire:model="subdomain" class="p-3 rounded-[4px] w-full h-[44px]" />
                            </div>
                            @if(isset($errorMessages['subdomain']))
                                <p class="relative text-sm text-red-600">{{ $errorMessages['subdomain'][0] }}</p>
                            @endif
                        </div>

                        <div class="mb-6">
                            <div class="my-1 flex">
                                <div style="font-weight: 400;line-height: 20px;" class="mr-1 text-[14px] text-[#6A6A75]">
                                    Tanggal Aktif
                                </div>
                                <div style="font-weight: 400;line-height: 20px;" class="text-[#FE5C5C] text-[14px]">
                                    *
                                </div>
                            </div>
                            <div>
                                <input wire:model="expired_date" type="date" class="p-3 rounded-[4px] w-full h-[44px]" />
                            </div>
                            @if(isset($errorMessages['expired_date']))
                                <p class="relative text-sm text-red-600">{{ $errorMessages['expired_date'][0] }}</p>
                            @endif
                        </div>

                        <div class="mb-6">
                            <div class="my-1 flex">
                                <div style="font-weight: 400;line-height: 20px;" class="mr-1 text-[14px] text-[#6A6A75]">
                                    Username
                                </div>
                                <div style="font-weight: 400;line-height: 20px;" class="text-[#FE5C5C] text-[14px]">
                                    *
                                </div>
                            </div>
                            <div>
                                <input wire:model="username" class="p-3 rounded-[4px] w-full h-[44px]" />
                            </div>
                            @if(isset($errorMessages['username']))
                                <p class="relative text-sm text-red-600">{{ $errorMessages['username'][0] }}</p>
                            @endif
                        </div>

                        <div class="mb-6">
                            <div class="my-1 flex">
                                <div style="font-weight: 400;line-height: 20px;" class="mr-1 text-[14px] text-[#6A6A75]">
                                    Password
                                </div>
                                <div style="font-weight: 400;line-height: 20px;" class="text-[#FE5C5C] text-[14px]">
                                    *
                                </div>
                            </div>
                            <div>
                                <input wire:model="password" type="password" class="p-3 rounded-[4px] w-full h-[44px]" />
                            </div>
                            @if(isset($errorMessages['password']))
                                <p class="relative text-sm text-red-600">{{ $errorMessages['password'][0] }}</p>
                            @endif
                        </div>

                        <div class="mb-6">
                            <div class="my-1 flex">
                                <div style="font-weight: 400;line-height: 20px;" class="mr-1 text-[14px] text-[#6A6A75]">
                                    Konfirmasi Password
                                </div>
                                <div style="font-weight: 400;line-height: 20px;" class="text-[#FE5C5C] text-[14px]">
                                    *
                                </div>
                            </div>
                            <div>
                                <input wire:model="passwordConfirmation" type="password" class="p-3 rounded-[4px] w-full h-[44px]" />
                            </div>
                        </div>

                        <div class="p-4 bg-[#F5F7F9] flex gap-5 justify-between items-center">
                            <div>
                                <div style="font-weight: 600;line-height: 24px;" class="mb-2 text-[20px]">
                                    Status Bisnis
                                </div>
                                <div style="font-weight: 400;line-height: 20px;" class="text-[16px] text-[#6A6A75] w-[300px]">
                                    Aktifkan/nonaktifkan bisnis dari system dengan klik toggle di kanan
                                </div>
                            </div>
                            <div wire:click="changeStatus" class="flex h-5 w-9 cursor-pointer items-center rounded-full p-1 dark:bg-dark-secondary {{ $status ? 'bg-primary' : 'bg-gray-400'}}">
                                <div class="toggle-circle h-4 w-4 rounded-full bg-white transition duration-300 {{ $status ? 'translate-x-3' : ''}} ease-in-out">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="sticky bottom-0 px-6 py-3 flex justify-end bg-[#F9FAFB] items-center no-select">
                    <div @click="showDetailForm=false" class="p-3 text-primary rounded-[4px] mr-[14px] cursor-pointer">
                        <div style="font-weight: 600;line-height: 20px;" class="text-[16px]">
                            Batal
                        </div>
                    </div>
                    <div wire:click="updateProfileCompany" class="p-3 bg-primary rounded-[4px] text-white cursor-pointer">
                        <div style="font-weight: 600;line-height: 20px;" class="text-[16px]">
                            Simpan
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div x-cloak x-show="showDetailPoint" class="bg-black bg-opacity-50 w-screen h-screen fixed top-0 left-0 z-[100] flex items-center justify-center">
        <div @click.outside="showDetailPoint=false" class="w-[446px] max-h-screen lg:max-h-none bg-white flex flex-col rounded-[4px]">
            <div class="flex-none px-5 py-[18px] border-b">
                <div class="flex items-center">
                    <div @click="showDetailPoint=false" class="mr-4">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                            <path d="M13.0594 12.0001L16.2563 8.80322C16.5469 8.5126 16.5469 8.03447 16.2563 7.74385C15.9656 7.45322 15.4875 7.45322 15.1969 7.74385L12 10.9407L8.80313 7.74385C8.5125 7.45322 8.03437 7.45322 7.74375 7.74385C7.59844 7.88916 7.52344 8.08135 7.52344 8.27354C7.52344 8.46572 7.59844 8.65791 7.74375 8.80322L10.9406 12.0001L7.74375 15.197C7.59844 15.3423 7.52344 15.5345 7.52344 15.7267C7.52344 15.9188 7.59844 16.111 7.74375 16.2563C8.03437 16.547 8.5125 16.547 8.80313 16.2563L12 13.0595L15.1969 16.2563C15.4875 16.547 15.9656 16.547 16.2563 16.2563C16.5469 15.9657 16.5469 15.4876 16.2563 15.197L13.0594 12.0001Z" fill="#B1B1B1"/>
                        </svg>
                    </div>
                    <div style="font-weight: 600;line-height: 20px;" class="text-[16px]">
                        Buat Bisnis Baru
                    </div>
                </div>
            </div>
            <div class="flex-1 overflow-y-auto hide-scrollbar lg:max-h-[700px]">
                <div class="px-6 py-6 mb-[68px]">
                    <div >
                        <div class="py-8">
                            <div class="mb-4">
                                <div style="font-weight: 600;line-height: 24px;" class="text-[20px] flex justify-center mb-2">
                                    Sistem  Penukaran Poin
                                </div>
                                <div style="font-weight: 400;line-height: 20px;" class="text-[16px] text-[#6A6A75] text-center">
                                    Poin akan diperoleh customer melalui kelipatan belanja tertentu. Sepakati & tentukan konversinya dengan pemilik bisnis
                                </div>
                            </div>

                            <div class="relative mb-3">
                                <input onclick="selectAllText(this)" oninput="formatRupiah(this)" wire:model="total_shopping" class="py-3 pr-3 pl-10 h-[44px] rounded-sm w-full" placeholder="Jumlah belanja" />
                                <div class="absolute p-1 top-[6px] pl-3">
                                    Rp
                                </div>
                            </div>

                            <div class="flex justify-center mb-3">
                                <div class="p-2 border border-[#D6DADF] rounded-full flex items-center justify-center bg-[#F5F7F9]">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                        <path d="M11.5174 18.2296C11.7518 17.9906 12.1408 17.9859 12.3799 18.2249L14.6252 20.4374L14.6252 9.89058C14.6252 9.55307 14.8971 9.2812 15.2346 9.2812C15.5721 9.2812 15.8439 9.55307 15.8439 9.89058L15.8439 20.4328L18.0893 18.2203C18.3283 17.9859 18.7127 17.9859 18.9518 18.2249C19.1861 18.464 19.1861 18.8484 18.9471 19.0875L15.6658 22.3218C15.6096 22.3734 15.5486 22.4203 15.4736 22.4484C15.3986 22.4812 15.3189 22.4953 15.2393 22.4953C15.0799 22.4953 14.9299 22.4343 14.8127 22.3218L11.5314 19.0874C11.2877 18.8531 11.283 18.4687 11.5174 18.2296ZM5.04863 5.77026C5.283 6.00933 5.67207 6.01401 5.91113 5.77495L8.15644 3.56714L8.15644 14.1093C8.15644 14.4468 8.42832 14.7187 8.76582 14.7187C9.10331 14.7187 9.37519 14.4468 9.37519 14.1093L9.37519 3.56714L11.6205 5.77964C11.8596 6.01401 12.2439 6.01401 12.483 5.77495C12.7174 5.53589 12.7174 5.15151 12.4783 4.91245L9.19707 1.67808C9.14082 1.62651 9.07988 1.57964 9.00488 1.55151C8.92988 1.5187 8.85019 1.50464 8.7705 1.50464C8.61113 1.50464 8.46113 1.56558 8.34394 1.67808L5.06269 4.91245C4.81894 5.14683 4.81425 5.5312 5.04863 5.77026Z" fill="#B1B1B1"/>
                                    </svg>
                                </div>
                            </div>

                            <div class="relative">
                                <input onclick="selectAllText(this)" oninput="onlyNumber(this)" wire:model="point" class="py-3 pr-3 pl-10 h-[44px] rounded-sm w-full" placeholder="Poin diperoleh" />
                                <div class="absolute p-1 top-[11px] pl-3">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 14 14" fill="none">
                                        <path d="M7.00277 12.8351C3.78102 12.8351 1.16943 10.2235 1.16943 7.00179C1.16943 3.78004 3.78102 1.16846 7.00277 1.16846C10.2245 1.16846 12.8361 3.78004 12.8361 7.00179C12.8361 10.2235 10.2245 12.8351 7.00277 12.8351ZM7.00277 4.52671L4.52768 7.00179L7.00277 9.47687L9.47727 7.00179L7.00277 4.52671Z" fill="#FFA858"/>
                                        <path fill-rule="evenodd" clip-rule="evenodd" d="M7.00282 3.7017L10.3021 7.00179L7.00282 10.3019L3.70273 7.00179L7.00282 3.7017ZM1.75277 7.00179C1.75277 9.90137 4.10318 12.2518 7.00277 12.2518C9.90235 12.2518 12.2528 9.90137 12.2528 7.00179C12.2528 4.10221 9.90235 1.75179 7.00277 1.75179C4.10318 1.75179 1.75277 4.10221 1.75277 7.00179ZM4.52768 7.00179L7.00277 4.52671L9.47727 7.00179L7.00277 9.47687L4.52768 7.00179ZM1.16943 7.00179C1.16943 10.2235 3.78102 12.8351 7.00277 12.8351C10.2245 12.8351 12.8361 10.2235 12.8361 7.00179C12.8361 3.78004 10.2245 1.16846 7.00277 1.16846C3.78102 1.16846 1.16943 3.78004 1.16943 7.00179Z" fill="#DF812B"/>
                                    </svg>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="sticky bottom-0 px-6 py-3 flex justify-end bg-[#F9FAFB] items-center no-select">
                    <div class="p-3 text-primary rounded-[4px] mr-[14px] cursor-pointer">
                        <div @click="showDetailPoint=false" style="font-weight: 600;line-height: 20px;" class="text-[16px]">
                            Batal
                        </div>
                    </div>
                    <div wire:click="updatePoint" class="p-3 bg-primary rounded-[4px] text-white cursor-pointer">
                        <div style="font-weight: 600;line-height: 20px;" class="text-[16px]">
                            Lanjut
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div x-cloak x-show="showCustomers" class="bg-black bg-opacity-50 w-screen h-screen fixed top-0 left-0 z-[100] flex items-center justify-center">
        <div @click.outside="showCustomers=false" class="w-[446px] max-h-screen lg:max-h-none bg-white flex flex-col rounded-[4px]">
            <div class="flex-none px-5 py-[18px] border-b">
                <div class="flex items-center">
                    <div @click="showCustomers=false" class="mr-4 cursor-pointer no-select">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                            <path d="M13.0594 12.0001L16.2563 8.80322C16.5469 8.5126 16.5469 8.03447 16.2563 7.74385C15.9656 7.45322 15.4875 7.45322 15.1969 7.74385L12 10.9407L8.80313 7.74385C8.5125 7.45322 8.03437 7.45322 7.74375 7.74385C7.59844 7.88916 7.52344 8.08135 7.52344 8.27354C7.52344 8.46572 7.59844 8.65791 7.74375 8.80322L10.9406 12.0001L7.74375 15.197C7.59844 15.3423 7.52344 15.5345 7.52344 15.7267C7.52344 15.9188 7.59844 16.111 7.74375 16.2563C8.03437 16.547 8.5125 16.547 8.80313 16.2563L12 13.0595L15.1969 16.2563C15.4875 16.547 15.9656 16.547 16.2563 16.2563C16.5469 15.9657 16.5469 15.4876 16.2563 15.197L13.0594 12.0001Z" fill="#B1B1B1"/>
                        </svg>
                    </div>
                    <div style="font-weight: 600;line-height: 20px;" class="text-[16px]">
                        Buat Bisnis Baru
                    </div>
                </div>
            </div>
            <div class="flex-1 overflow-y-auto hide-scrollbar lg:max-h-[700px]">
                <div class="px-6 py-6 mb-[68px]">
                    <div style="font-weight: 700;line-height: 32px;" class="text-[24px] mb-2">
                        Customer
                    </div>
                    <div style="font-weight: 400;line-height: 20px;" class="text-[16px] text-[#6A6A75] mb-6">
                        {{ $company_name }}asd
                    </div>
                    <div class="relative mb-6">
                        <input wire:model="searchCustomer" class="w-full py-3 pr-3 pl-10 mr-5" placeholder="Cari customer/no hp." />
                        <div class="absolute top-[15px] ml-3">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20" fill="none">
                                <path d="M17.3242 16.4141L13.1523 12.2031C13.9688 11.1797 14.4609 9.88281 14.4609 8.47266C14.4609 5.17188 11.7852 2.49609 8.48047 2.49609C5.17578 2.49609 2.5 5.17578 2.5 8.47656C2.5 11.7773 5.17578 14.4531 8.48047 14.4531C9.91016 14.4531 11.2188 13.9531 12.25 13.1172L16.3945 17.3008C16.5195 17.4336 16.6914 17.5 16.8594 17.5C17.0195 17.5 17.1797 17.4414 17.3008 17.3242C17.5586 17.0781 17.5664 16.6719 17.3242 16.4141ZM8.48047 13.168C7.22656 13.168 6.04688 12.6797 5.16016 11.793C4.27344 10.9062 3.78516 9.72656 3.78516 8.47656C3.78516 7.22266 4.27344 6.04297 5.16016 5.16016C6.04688 4.27344 7.22656 3.78516 8.48047 3.78516C9.73438 3.78516 10.9141 4.27344 11.8008 5.16016C12.6875 6.04688 13.1758 7.22656 13.1758 8.47656C13.1758 9.73047 12.6875 10.9102 11.8008 11.793C10.9141 12.6797 9.73438 13.168 8.48047 13.168Z" fill="#6A6A75"/>
                            </svg>
                        </div>
                        @foreach ($customers as $index => $customer)
                        <div class="p-4 border-b flex">
                            <div style="font-weight: 600;line-height: 20px;" class="w-10 h-10 rounded-full mr-2 bg-[#E5EDFA] flex items-center justify-center text-[16px]">
                                MS
                            </div>
                            <div class="max-w-[290px]">
                                <div style="font-weight: 600;line-height: 24px;" class="text[18px] mb-1 truncate">
                                    {{$customer->name}}
                                </div>
                                <div style="font-weight: 400;line-height: 20px;" class="mb-1 text-[16px] text-[#6A6A75] truncate">
                                    {{$customer->phone_number}}
                                </div>
                                <div class="flex gap-[14px] items-center">
                                    <div class="px-2 py-1 border rounded-full flex items-center gap-1">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20" fill="none">
                                            <path d="M10.0042 18.3356C5.40173 18.3356 1.6709 14.6048 1.6709 10.0023C1.6709 5.39978 5.40173 1.66895 10.0042 1.66895C14.6067 1.66895 18.3376 5.39978 18.3376 10.0023C18.3376 14.6048 14.6067 18.3356 10.0042 18.3356ZM10.0042 6.46644L6.4684 10.0023L10.0042 13.5381L13.5392 10.0023L10.0042 6.46644Z" fill="#FFA858"/>
                                            <path fill-rule="evenodd" clip-rule="evenodd" d="M10.0043 5.28835L14.7176 10.0028L10.0043 14.7172L5.28989 10.0028L10.0043 5.28835ZM2.50423 10.0028C2.50423 14.145 5.86197 17.5028 10.0042 17.5028C14.1465 17.5028 17.5042 14.145 17.5042 10.0028C17.5042 5.8605 14.1465 2.50277 10.0042 2.50277C5.86197 2.50277 2.50423 5.8605 2.50423 10.0028ZM6.4684 10.0028L10.0042 6.46693L13.5392 10.0028L10.0042 13.5386L6.4684 10.0028ZM1.6709 10.0028C1.6709 14.6053 5.40173 18.3361 10.0042 18.3361C14.6067 18.3361 18.3376 14.6053 18.3376 10.0028C18.3376 5.40027 14.6067 1.66943 10.0042 1.66943C5.40173 1.66943 1.6709 5.40027 1.6709 10.0028Z" fill="#DF812B"/>
                                        </svg>
                                        <div style="font-weight: 400;line-height: 20px;" class="text-[14px] max-w-[30px] line-clamp-1">
                                            {{$customer->total_point}} pts
                                        </div>
                                    </div>

                                    <?php
                                        $totalVouchers = 0;
                                        $totalGifts = 0;
                                        if(count($customers) > 0){
                                            foreach($customer->claimmed as $claim){
                                                if($claim->claim->claim_type_id == 1){
                                                    $totalVouchers++;
                                                }else{
                                                    $totalGifts++;
                                                }
                                            }
                                        }
                                    ?>
                                    <div class="px-2 py-1 border rounded-full flex items-center gap-1">
                                        <div class="flex items-center justify-center p-[6px]">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 12 12" fill="none">
                                                <path d="M10.5 2.5H1.5C1.36739 2.5 1.24021 2.55268 1.14645 2.64645C1.05268 2.74021 1 2.86739 1 3V5H1.4465C1.9445 5 2.4065 5.3405 2.4865 5.832C2.51087 5.97552 2.50363 6.12263 2.46528 6.26306C2.42693 6.40349 2.3584 6.53386 2.26447 6.64508C2.17054 6.75629 2.05347 6.84567 1.92143 6.90697C1.7894 6.96827 1.64557 7.00002 1.5 7H1V9C1 9.13261 1.05268 9.25979 1.14645 9.35355C1.24021 9.44732 1.36739 9.5 1.5 9.5H10.5C10.6326 9.5 10.7598 9.44732 10.8536 9.35355C10.9473 9.25979 11 9.13261 11 9V7H10.5C10.3544 7.00002 10.2106 6.96827 10.0786 6.90697C9.94653 6.84567 9.82946 6.75629 9.73553 6.64508C9.6416 6.53386 9.57307 6.40349 9.53472 6.26306C9.49637 6.12263 9.48913 5.97552 9.5135 5.832C9.5935 5.3405 10.0555 5 10.5535 5H11V3C11 2.86739 10.9473 2.74021 10.8536 2.64645C10.7598 2.55268 10.6326 2.5 10.5 2.5ZM5.5 8.5H4.5V7.5H5.5V8.5ZM5.5 6.5H4.5V5.5H5.5V6.5ZM5.5 4.5H4.5V3.5H5.5V4.5Z" fill="#3688EF"/>
                                            </svg>
                                        </div>
                                        <div style="font-weight: 400;line-height: 20px;" class="text-[16px] text-[#6A6A75] max-w-[30px] line-clamp-1">
                                            {{$totalVouchers}}
                                        </div>
                                    </div>
                                    <div class="px-2 py-1 border rounded-full flex items-center gap-1">
                                        <div class="flex items-center justify-center p-[6px]">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 12 12" fill="none">
                                                <path d="M4.53 0.964864C3.585 0.959864 2.665 1.86986 3.085 2.99986H1.5C1.23478 2.99986 0.98043 3.10522 0.792893 3.29276C0.605357 3.48029 0.5 3.73465 0.5 3.99986V4.99986C0.5 5.13247 0.552678 5.25965 0.646447 5.35342C0.740215 5.44719 0.867392 5.49986 1 5.49986H5.5V3.99986H6.5V5.49986H11C11.1326 5.49986 11.2598 5.44719 11.3536 5.35342C11.4473 5.25965 11.5 5.13247 11.5 4.99986V3.99986C11.5 3.73465 11.3946 3.48029 11.2071 3.29276C11.0196 3.10522 10.7652 2.99986 10.5 2.99986H8.915C9.5 1.36486 7.3 0.209864 6.285 1.61986L6 1.99986L5.715 1.60986C5.4 1.16486 4.965 0.969864 4.53 0.964864ZM4.5 1.99986C4.945 1.99986 5.17 2.53986 4.855 2.85486C4.54 3.16986 4 2.94486 4 2.49986C4 2.36726 4.05268 2.24008 4.14645 2.14631C4.24021 2.05254 4.36739 1.99986 4.5 1.99986ZM7.5 1.99986C7.945 1.99986 8.17 2.53986 7.855 2.85486C7.54 3.16986 7 2.94486 7 2.49986C7 2.36726 7.05268 2.24008 7.14645 2.14631C7.24021 2.05254 7.36739 1.99986 7.5 1.99986ZM1 5.99986V9.99986C1 10.2651 1.10536 10.5194 1.29289 10.707C1.48043 10.8945 1.73478 10.9999 2 10.9999H10C10.2652 10.9999 10.5196 10.8945 10.7071 10.707C10.8946 10.5194 11 10.2651 11 9.99986V5.99986H6.5V9.99986H5.5V5.99986H1Z" fill="#FE5C5C"/>
                                            </svg>
                                        </div>
                                        <div style="font-weight: 400;line-height: 20px;" class="text-[16px] text-[#6A6A75] max-w-[30px] line-clamp-1">
                                            {{$totalGifts}}
                                        </div>
                                    </div>
                                    <div class="px-2 py-1 border rounded-full flex items-center gap-1">
                                        <div class="flex items-center justify-center p-[6px]">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 16 16" fill="none">
                                                <path fill-rule="evenodd" clip-rule="evenodd" d="M6.65884 2.5988C6.82767 2.41024 7.03437 2.25941 7.26543 2.15615C7.4965 2.05289 7.74675 1.99951 7.99984 1.99951C8.25294 1.99951 8.50318 2.05289 8.73425 2.15615C8.96532 2.25941 9.17201 2.41024 9.34084 2.5988L9.76084 3.068C9.82086 3.13514 9.89523 3.18791 9.97843 3.22239C10.0616 3.25688 10.1515 3.27219 10.2414 3.2672L10.8714 3.2324C11.1241 3.21852 11.3768 3.25806 11.6131 3.34844C11.8494 3.43881 12.064 3.57799 12.2429 3.75689C12.4218 3.9358 12.561 4.15041 12.6514 4.38673C12.7418 4.62305 12.7813 4.87577 12.7674 5.1284L12.7326 5.7584C12.7277 5.84822 12.7431 5.938 12.7776 6.02108C12.8121 6.10417 12.8648 6.17844 12.9318 6.2384L13.4016 6.6584C13.5903 6.82723 13.7412 7.03396 13.8445 7.26508C13.9479 7.49621 14.0013 7.74653 14.0013 7.9997C14.0013 8.25286 13.9479 8.50319 13.8445 8.73431C13.7412 8.96543 13.5903 9.17216 13.4016 9.341L12.9318 9.761C12.8647 9.82102 12.8119 9.89539 12.7774 9.97858C12.743 10.0618 12.7276 10.1517 12.7326 10.2416L12.7674 10.8716C12.7813 11.1242 12.7418 11.3769 12.6514 11.6133C12.561 11.8496 12.4218 12.0642 12.2429 12.2431C12.064 12.422 11.8494 12.5612 11.6131 12.6516C11.3768 12.7419 11.1241 12.7815 10.8714 12.7676L10.2414 12.7328C10.1516 12.7279 10.0618 12.7432 9.97876 12.7777C9.89567 12.8122 9.8214 12.8649 9.76144 12.932L9.34144 13.4018C9.17261 13.5904 8.96588 13.7414 8.73476 13.8447C8.50363 13.948 8.25331 14.0014 8.00014 14.0014C7.74697 14.0014 7.49665 13.948 7.26553 13.8447C7.0344 13.7414 6.82768 13.5904 6.65884 13.4018L6.23884 12.932C6.17882 12.8649 6.10445 12.8121 6.02126 12.7776C5.93806 12.7431 5.84817 12.7278 5.75824 12.7328L5.12824 12.7676C4.87561 12.7815 4.6229 12.7419 4.38658 12.6516C4.15026 12.5612 3.93565 12.422 3.75674 12.2431C3.57784 12.0642 3.43866 11.8496 3.34828 11.6133C3.25791 11.3769 3.21837 11.1242 3.23224 10.8716L3.26704 10.2416C3.27195 10.1518 3.25659 10.062 3.22211 9.97891C3.18763 9.89582 3.1349 9.82155 3.06784 9.7616L2.59864 9.3416C2.40999 9.17276 2.25907 8.96603 2.15575 8.73491C2.05243 8.50379 1.99902 8.25346 1.99902 8.0003C1.99902 7.74713 2.05243 7.49681 2.15575 7.26568C2.25907 7.03456 2.40999 6.82783 2.59864 6.659L3.06784 6.239C3.13499 6.17897 3.18776 6.10461 3.22224 6.02141C3.25673 5.93821 3.27204 5.84832 3.26704 5.7584L3.23224 5.1284C3.21837 4.87577 3.25791 4.62305 3.34828 4.38673C3.43866 4.15041 3.57784 3.9358 3.75674 3.75689C3.93565 3.57799 4.15026 3.43881 4.38658 3.34844C4.6229 3.25806 4.87561 3.21852 5.12824 3.2324L5.75824 3.2672C5.84807 3.2721 5.93784 3.25674 6.02093 3.22226C6.10401 3.18778 6.17829 3.13506 6.23824 3.068L6.65824 2.5988H6.65884ZM10.224 5.7758C10.3365 5.88831 10.3997 6.0409 10.3997 6.2C10.3997 6.35909 10.3365 6.51168 10.224 6.6242L6.62404 10.2242C6.51088 10.3335 6.35932 10.394 6.202 10.3926C6.04468 10.3912 5.8942 10.3281 5.78295 10.2169C5.67171 10.1056 5.60861 9.95515 5.60724 9.79784C5.60587 9.64052 5.66635 9.48896 5.77564 9.3758L9.37564 5.7758C9.48816 5.66331 9.64074 5.60012 9.79984 5.60012C9.95894 5.60012 10.1115 5.66331 10.224 5.7758ZM6.49984 5.6C6.26115 5.6 6.03223 5.69482 5.86345 5.8636C5.69466 6.03238 5.59984 6.2613 5.59984 6.5V6.506C5.59984 6.74469 5.69466 6.97361 5.86345 7.14239C6.03223 7.31118 6.26115 7.406 6.49984 7.406H6.50584C6.74454 7.406 6.97346 7.31118 7.14224 7.14239C7.31102 6.97361 7.40584 6.74469 7.40584 6.506V6.5C7.40584 6.2613 7.31102 6.03238 7.14224 5.8636C6.97346 5.69482 6.74454 5.6 6.50584 5.6H6.49984ZM9.49984 8.6C9.26115 8.6 9.03223 8.69482 8.86345 8.8636C8.69466 9.03238 8.59984 9.2613 8.59984 9.5V9.506C8.59984 9.74469 8.69466 9.97361 8.86345 10.1424C9.03223 10.3112 9.26115 10.406 9.49984 10.406H9.50584C9.74454 10.406 9.97346 10.3112 10.1422 10.1424C10.311 9.97361 10.4058 9.74469 10.4058 9.506V9.5C10.4058 9.2613 10.311 9.03238 10.1422 8.8636C9.97346 8.69482 9.74454 8.6 9.50584 8.6H9.49984Z" fill="#2C9854"/>
                                            </svg>
                                        </div>
                                        <div style="font-weight: 400;line-height: 20px;" class="text-[16px] text-[#6A6A75] max-w-[30px] line-clamp-1">
                                            -
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div x-cloak x-show="showDetailClaims" class="bg-[#D6DADF] w-screen min-h-screen fixed top-0 left-0 flex mt-[92.8px] justify-center">
        <div class="mt-8 w-[662px] flex flex-col">
            <div class="flex-none">
                <div class="flex items-center mb-4">
                    <div @click="showDetailClaims=false" class="no-select cursor-pointer flex items-center">
                        <div class="mr-1">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20" fill="none">
                                <path d="M8.45312 6.39459C8.65234 6.5899 8.65234 6.91412 8.45703 7.11334L6.08594 9.49224H15.1211C15.3984 9.49224 15.625 9.71881 15.625 10.0001C15.625 10.2813 15.3984 10.5079 15.1211 10.5079H6.08594L8.46094 12.8868C8.65625 13.086 8.65234 13.4063 8.45703 13.6055C8.25781 13.8008 7.94141 13.8008 7.74219 13.6016L4.52344 10.3594C4.48047 10.3126 4.44531 10.2618 4.41797 10.1993C4.39062 10.1368 4.37891 10.0704 4.37891 10.004C4.37891 9.87115 4.42969 9.74615 4.52344 9.64849L7.74219 6.40631C7.93359 6.20318 8.25391 6.19928 8.45312 6.39459Z" fill="#3688EF"/>
                            </svg>
                        </div>
                        <div style="font-weight: 600;line-height: 20px;" class="text-primary text-[16px]">
                            Kembali ke Daftar Bisnis
                        </div>
                    </div>
                </div>
            </div>

            <div class="w-full flex-1 bg-white rounded-sm overflow-auto p-6 max-h-[600px] hide-scrollbar">
                <div class="relative mb-6">
                    <input wire:model="searchClaim" class="py-3 pr-3 pl-10 mr-5 w-full" placeholder="Cari Penawaran" />
                    <div class="absolute top-[15px] ml-3">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20" fill="none">
                            <path d="M17.3242 16.4141L13.1523 12.2031C13.9688 11.1797 14.4609 9.88281 14.4609 8.47266C14.4609 5.17188 11.7852 2.49609 8.48047 2.49609C5.17578 2.49609 2.5 5.17578 2.5 8.47656C2.5 11.7773 5.17578 14.4531 8.48047 14.4531C9.91016 14.4531 11.2188 13.9531 12.25 13.1172L16.3945 17.3008C16.5195 17.4336 16.6914 17.5 16.8594 17.5C17.0195 17.5 17.1797 17.4414 17.3008 17.3242C17.5586 17.0781 17.5664 16.6719 17.3242 16.4141ZM8.48047 13.168C7.22656 13.168 6.04688 12.6797 5.16016 11.793C4.27344 10.9062 3.78516 9.72656 3.78516 8.47656C3.78516 7.22266 4.27344 6.04297 5.16016 5.16016C6.04688 4.27344 7.22656 3.78516 8.48047 3.78516C9.73438 3.78516 10.9141 4.27344 11.8008 5.16016C12.6875 6.04688 13.1758 7.22656 13.1758 8.47656C13.1758 9.73047 12.6875 10.9102 11.8008 11.793C10.9141 12.6797 9.73438 13.168 8.48047 13.168Z" fill="#6A6A75"/>
                        </svg>
                    </div>
                </div>
                <div class="mb-6 flex gap-3 items-center">
                    <div style="font-weight: 400;line-height: 20px" @click="showVouchers=true;showGifts=false;showPromotions=false" :class="showVouchers ? 'border-primary bg-[#EAF2FA] text-primary' : 'text-dark-primary'" class="px-3 no-select cursor-pointer py-2 flex items-center gap-1 border-2 rounded-full">
                        <div class="text-[14px]">
                            Voucher
                        </div>
                        <div class="text-[14px]">
                            <div :class="showVouchers ? 'bg-white' : 'bg-[#F5F7F9]'" class="px-1 rounded-full">
                                <div class="w-5 h-5 flex justify-center items-center">
                                    {{count($vouchers)}}
                                </div>
                            </div>
                        </div>
                    </div>
                    <div style="font-weight: 400;line-height: 20px" @click="showVouchers=false;showGifts=true;showPromotions=false" :class="showGifts ? 'border-primary bg-[#EAF2FA] text-primary' : 'text-dark-primary'" class="px-3 no-select cursor-pointer py-2 flex items-center gap-1 border-2 rounded-full">
                        <div class="text-[14px]">
                            Hadiah
                        </div>
                        <div class="text-[14px]">
                            <div :class="showVouchers ? 'bg-white' : 'bg-[#F5F7F9]'" class="px-1 rounded-full">
                                <div class="w-5 h-5 flex justify-center items-center">
                                    {{count($gifts)}}
                                </div>
                            </div>
                        </div>
                    </div>
                    <div style="font-weight: 400;line-height: 20px" @click="showVouchers=false;showGifts=false;showPromotions=true" :class="showPromotions ? 'border-primary bg-[#EAF2FA] text-primary' : 'text-dark-primary'" class="px-3 no-select cursor-pointer py-2 flex items-center gap-1 border-2 rounded-full">
                        <div class="text-[14px]">
                            Promo
                        </div>
                        <div class="text-[14px]">
                            <div :class="showVouchers ? 'bg-white' : 'bg-[#F5F7F9]'" class="px-1 rounded-full">
                                <div class="w-5 h-5 flex justify-center items-center">
                                    {{count($promotions)}}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div x-show="showVouchers" class="gap-4">
                    @foreach ($vouchers as $voucher)
                    <div wire:click="detailClaim({{$voucher->id}}, 1)" class="flex justify-between items-center p-4 border-b no-select cursor-pointer">
                        <div class="flex items-start gap-2">
                            <div class="w-10 h-10 bg-[#E5EDFA] rounded-full flex items-center justify-center">
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20" fill="none">
                                    <path d="M17.4998 4.1665H2.49984C2.27882 4.1665 2.06686 4.2543 1.91058 4.41058C1.7543 4.56686 1.6665 4.77882 1.6665 4.99984V8.33317H2.41067C3.24067 8.33317 4.01067 8.90067 4.144 9.71984C4.18462 9.95903 4.17255 10.2042 4.10864 10.4383C4.04473 10.6723 3.93051 10.8896 3.77396 11.075C3.6174 11.2603 3.42229 11.4093 3.20223 11.5114C2.98217 11.6136 2.74246 11.6665 2.49984 11.6665H1.6665V14.9998C1.6665 15.2209 1.7543 15.4328 1.91058 15.5891C2.06686 15.7454 2.27882 15.8332 2.49984 15.8332H17.4998C17.7208 15.8332 17.9328 15.7454 18.0891 15.5891C18.2454 15.4328 18.3332 15.2209 18.3332 14.9998V11.6665H17.4998C17.2572 11.6665 17.0175 11.6136 16.7974 11.5114C16.5774 11.4093 16.3823 11.2603 16.2257 11.075C16.0692 10.8896 15.9549 10.6723 15.891 10.4383C15.8271 10.2042 15.8151 9.95903 15.8557 9.71984C15.989 8.90067 16.759 8.33317 17.589 8.33317H18.3332V4.99984C18.3332 4.77882 18.2454 4.56686 18.0891 4.41058C17.9328 4.2543 17.7208 4.1665 17.4998 4.1665ZM9.1665 14.1665H7.49984V12.4998H9.1665V14.1665ZM9.1665 10.8332H7.49984V9.1665H9.1665V10.8332ZM9.1665 7.49984H7.49984V5.83317H9.1665V7.49984Z" fill="#3688EF"/>
                                </svg>
                            </div>
                            <div class="gap-1">
                                <div style="font-weight: 600;line-height: 24px;" class="text-[18px] max-w-[350px] truncate">
                                    {{$voucher->title}}
                                </div>
                                <div style="font-weight: 400;line-height: 20px; " class="text-[16px] text-[#6A6A75] max-w-[350px] line-clamp-2">
                                    {{$voucher->description}}
                                </div>
                                <div class="flex items-center gap-5">
                                    <div class="flex items-center gap-[3px]">
                                        <div>
                                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20" fill="none">
                                                <path d="M15.8332 10.8332H4.1665V9.1665H15.8332V10.8332ZM9.99984 4.1665C10.4419 4.1665 10.8658 4.3421 11.1783 4.65466C11.4909 4.96722 11.6665 5.39114 11.6665 5.83317C11.6665 6.2752 11.4909 6.69912 11.1783 7.01168C10.8658 7.32424 10.4419 7.49984 9.99984 7.49984C9.55781 7.49984 9.13389 7.32424 8.82133 7.01168C8.50877 6.69912 8.33317 6.2752 8.33317 5.83317C8.33317 5.39114 8.50877 4.96722 8.82133 4.65466C9.13389 4.3421 9.55781 4.1665 9.99984 4.1665ZM9.99984 12.4998C10.4419 12.4998 10.8658 12.6754 11.1783 12.988C11.4909 13.3006 11.6665 13.7245 11.6665 14.1665C11.6665 14.6085 11.4909 15.0325 11.1783 15.345C10.8658 15.6576 10.4419 15.8332 9.99984 15.8332C9.55781 15.8332 9.13389 15.6576 8.82133 15.345C8.50877 15.0325 8.33317 14.6085 8.33317 14.1665C8.33317 13.7245 8.50877 13.3006 8.82133 12.988C9.13389 12.6754 9.55781 12.4998 9.99984 12.4998Z" fill="#6A6A75"/>
                                            </svg>
                                        </div>
                                        <div style="font-weight: 400;line-height: 20px;" class="text-[14px]">
                                            {{ 60 - count($voucher->claimmed) }} dari 60 tersisa
                                        </div>
                                    </div>
                                    <div class="flex items-center gap-[3px]">
                                        <div>
                                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20" fill="none">
                                                <path d="M14.3754 10.625H10.6254V14.375H14.3754V10.625ZM13.1254 2.5V3.75H6.87539V2.5H5.00039V3.75H4.0625C3.20305 3.75 2.5 4.45305 2.5 5.3125V15.9375C2.5 16.797 3.20305 17.5 4.0625 17.5H15.9379C16.7973 17.5 17.5004 16.797 17.5004 15.9375V5.3125C17.5004 4.45305 16.7973 3.75 15.9379 3.75H15.0004V2.5H13.1254ZM15.9379 15.9375H4.0625V7.65625H15.9379V15.9375Z" fill="#6A6A75"/>
                                            </svg>
                                        </div>
                                        <div style="font-weight: 400;line-height: 20px;" class="text-[14px]">
                                            {{changeDateFormat($voucher->start_date)}} - {{changeDateFormat($voucher->end_date)}}
                                        </div>
                                    </div>
                                    <div class="flex items-center gap-[3px]">
                                        <div>
                                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20" fill="none">
                                                <path d="M2.5 17.5H4.16667M4.16667 17.5H15.8333M4.16667 17.5V7.77333M17.5 17.5H15.8333M15.8333 17.5V7.77333M4.16667 7.77333C4.13551 7.75544 4.10494 7.73654 4.075 7.71667L3.625 7.41667C3.30688 7.20448 3.0714 6.88935 2.95806 6.52414C2.84472 6.15893 2.86041 5.76585 3.0025 5.41083L3.7475 3.5475C3.87124 3.23825 4.0848 2.97318 4.36063 2.78647C4.63647 2.59976 4.96192 2.49998 5.295 2.5H14.705C15.0381 2.49998 15.3635 2.59976 15.6394 2.78647C15.9152 2.97318 16.1288 3.23825 16.2525 3.5475L16.9975 5.41083C17.1396 5.76585 17.1553 6.15893 17.0419 6.52414C16.9286 6.88935 16.6931 7.20448 16.375 7.41667L15.925 7.71667C15.8951 7.73654 15.8645 7.75544 15.8333 7.77333M4.16667 7.77333C4.43587 7.92882 4.7432 8.00591 5.05392 7.99589C5.36464 7.98588 5.66636 7.88916 5.925 7.71667L7.5 6.66667L9.075 7.71667C9.34888 7.8994 9.67075 7.99692 10 7.99692C10.3292 7.99692 10.6511 7.8994 10.925 7.71667L12.5 6.66667L14.075 7.71667C14.3336 7.88916 14.6354 7.98588 14.9461 7.99589C15.2568 8.00591 15.5641 7.92882 15.8333 7.77333" stroke="#6A6A75" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                                <path d="M11.6668 17.4998V13.3332C11.6668 12.8911 11.4912 12.4672 11.1787 12.1547C10.8661 11.8421 10.4422 11.6665 10.0002 11.6665C9.55814 11.6665 9.13421 11.8421 8.82165 12.1547C8.50909 12.4672 8.3335 12.8911 8.3335 13.3332V17.4998" stroke="#6A6A75" stroke-width="1.5"/>
                                            </svg>
                                        </div>
                                        <div style="font-weight: 400;line-height: 20px;" class="text-[14px]">
                                            {{count($voucher->claimStores)}} Cabang
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div>
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                <path d="M13.7858 12L7.82803 6.04688C7.3874 5.60625 7.3874 4.89375 7.82803 4.45781C8.26865 4.02188 8.98115 4.02188 9.42178 4.45781L16.1718 11.2031C16.5983 11.6297 16.6077 12.3141 16.2046 12.7547L9.42647 19.5469C9.20615 19.7672 8.91553 19.875 8.62959 19.875C8.34365 19.875 8.05303 19.7672 7.83272 19.5469C7.39209 19.1062 7.39209 18.3938 7.83272 17.9578L13.7858 12Z" fill="#B1B1B1"/>
                            </svg>
                        </div>
                    </div>
                    @endforeach
                </div>
                <div x-show="showGifts" class="gap-4">
                    @foreach ($gifts as $gift)
                    <div wire:click="detailClaim({{$gift->id}}, 1)" class="flex justify-between items-center p-4 border-b cursor-pointer no-select">
                        <div class="flex items-start gap-2">
                            <div class="w-10 h-10 bg-[#FAE4E4] rounded-full flex items-center justify-center">
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 13 12" fill="none">
                                    <g clip-path="url(#clip0_617_325)">
                                        <path d="M4.86331 0.964864C3.91831 0.959864 2.99831 1.86986 3.41831 2.99986H1.83331C1.5681 2.99986 1.31374 3.10522 1.12621 3.29276C0.93867 3.48029 0.833313 3.73465 0.833313 3.99986V4.99986C0.833313 5.13247 0.885991 5.25965 0.97976 5.35342C1.07353 5.44719 1.2007 5.49986 1.33331 5.49986H5.83331V3.99986H6.83331V5.49986H11.3333C11.4659 5.49986 11.5931 5.44719 11.6869 5.35342C11.7806 5.25965 11.8333 5.13247 11.8333 4.99986V3.99986C11.8333 3.73465 11.728 3.48029 11.5404 3.29276C11.3529 3.10522 11.0985 2.99986 10.8333 2.99986H9.24831C9.83331 1.36486 7.63331 0.209864 6.61831 1.61986L6.33331 1.99986L6.04831 1.60986C5.73331 1.16486 5.29831 0.969864 4.86331 0.964864ZM4.83331 1.99986C5.27831 1.99986 5.50331 2.53986 5.18831 2.85486C4.87331 3.16986 4.33331 2.94486 4.33331 2.49986C4.33331 2.36726 4.38599 2.24008 4.47976 2.14631C4.57353 2.05254 4.7007 1.99986 4.83331 1.99986ZM7.83331 1.99986C8.27831 1.99986 8.50331 2.53986 8.18831 2.85486C7.87331 3.16986 7.33331 2.94486 7.33331 2.49986C7.33331 2.36726 7.38599 2.24008 7.47976 2.14631C7.57353 2.05254 7.7007 1.99986 7.83331 1.99986ZM1.33331 5.99986V9.99986C1.33331 10.2651 1.43867 10.5194 1.62621 10.707C1.81374 10.8945 2.0681 10.9999 2.33331 10.9999H10.3333C10.5985 10.9999 10.8529 10.8945 11.0404 10.707C11.228 10.5194 11.3333 10.2651 11.3333 9.99986V5.99986H6.83331V9.99986H5.83331V5.99986H1.33331Z" fill="#FE5C5C"/>
                                    </g>
                                    <defs>
                                        <clipPath id="clip0_617_325">
                                            <rect width="12" height="12" fill="white" transform="translate(0.333313)"/>
                                        </clipPath>
                                    </defs>
                                </svg>
                            </div>
                            <div class="gap-1">
                                <div style="font-weight: 600;line-height: 24px;" class="text-[18px] max-w-[350px] truncate">
                                    {{$gift->title}}
                                </div>
                                <div style="font-weight: 400;line-height: 20px; " class="text-[16px] text-[#6A6A75] max-w-[350px] line-clamp-2">
                                    {{$gift->description}}
                                </div>
                                <div class="flex items-center gap-5">
                                    <div class="flex items-center gap-[3px]">
                                        <div>
                                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20" fill="none">
                                                <path d="M15.8332 10.8332H4.1665V9.1665H15.8332V10.8332ZM9.99984 4.1665C10.4419 4.1665 10.8658 4.3421 11.1783 4.65466C11.4909 4.96722 11.6665 5.39114 11.6665 5.83317C11.6665 6.2752 11.4909 6.69912 11.1783 7.01168C10.8658 7.32424 10.4419 7.49984 9.99984 7.49984C9.55781 7.49984 9.13389 7.32424 8.82133 7.01168C8.50877 6.69912 8.33317 6.2752 8.33317 5.83317C8.33317 5.39114 8.50877 4.96722 8.82133 4.65466C9.13389 4.3421 9.55781 4.1665 9.99984 4.1665ZM9.99984 12.4998C10.4419 12.4998 10.8658 12.6754 11.1783 12.988C11.4909 13.3006 11.6665 13.7245 11.6665 14.1665C11.6665 14.6085 11.4909 15.0325 11.1783 15.345C10.8658 15.6576 10.4419 15.8332 9.99984 15.8332C9.55781 15.8332 9.13389 15.6576 8.82133 15.345C8.50877 15.0325 8.33317 14.6085 8.33317 14.1665C8.33317 13.7245 8.50877 13.3006 8.82133 12.988C9.13389 12.6754 9.55781 12.4998 9.99984 12.4998Z" fill="#6A6A75"/>
                                            </svg>
                                        </div>
                                        <div style="font-weight: 400;line-height: 20px;" class="text-[14px]">
                                            {{ 60 - count($gift->claimmed) }} dari 60 tersisa
                                        </div>
                                    </div>
                                    <div class="flex items-center gap-[3px]">
                                        <div>
                                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20" fill="none">
                                                <path d="M14.3754 10.625H10.6254V14.375H14.3754V10.625ZM13.1254 2.5V3.75H6.87539V2.5H5.00039V3.75H4.0625C3.20305 3.75 2.5 4.45305 2.5 5.3125V15.9375C2.5 16.797 3.20305 17.5 4.0625 17.5H15.9379C16.7973 17.5 17.5004 16.797 17.5004 15.9375V5.3125C17.5004 4.45305 16.7973 3.75 15.9379 3.75H15.0004V2.5H13.1254ZM15.9379 15.9375H4.0625V7.65625H15.9379V15.9375Z" fill="#6A6A75"/>
                                            </svg>
                                        </div>
                                        <div style="font-weight: 400;line-height: 20px;" class="text-[14px]">
                                            {{changeDateFormat($gift->start_date)}} - {{changeDateFormat($gift->end_date)}}
                                        </div>
                                    </div>
                                    <div class="flex items-center gap-[3px]">
                                        <div>
                                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20" fill="none">
                                                <path d="M2.5 17.5H4.16667M4.16667 17.5H15.8333M4.16667 17.5V7.77333M17.5 17.5H15.8333M15.8333 17.5V7.77333M4.16667 7.77333C4.13551 7.75544 4.10494 7.73654 4.075 7.71667L3.625 7.41667C3.30688 7.20448 3.0714 6.88935 2.95806 6.52414C2.84472 6.15893 2.86041 5.76585 3.0025 5.41083L3.7475 3.5475C3.87124 3.23825 4.0848 2.97318 4.36063 2.78647C4.63647 2.59976 4.96192 2.49998 5.295 2.5H14.705C15.0381 2.49998 15.3635 2.59976 15.6394 2.78647C15.9152 2.97318 16.1288 3.23825 16.2525 3.5475L16.9975 5.41083C17.1396 5.76585 17.1553 6.15893 17.0419 6.52414C16.9286 6.88935 16.6931 7.20448 16.375 7.41667L15.925 7.71667C15.8951 7.73654 15.8645 7.75544 15.8333 7.77333M4.16667 7.77333C4.43587 7.92882 4.7432 8.00591 5.05392 7.99589C5.36464 7.98588 5.66636 7.88916 5.925 7.71667L7.5 6.66667L9.075 7.71667C9.34888 7.8994 9.67075 7.99692 10 7.99692C10.3292 7.99692 10.6511 7.8994 10.925 7.71667L12.5 6.66667L14.075 7.71667C14.3336 7.88916 14.6354 7.98588 14.9461 7.99589C15.2568 8.00591 15.5641 7.92882 15.8333 7.77333" stroke="#6A6A75" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                                <path d="M11.6668 17.4998V13.3332C11.6668 12.8911 11.4912 12.4672 11.1787 12.1547C10.8661 11.8421 10.4422 11.6665 10.0002 11.6665C9.55814 11.6665 9.13421 11.8421 8.82165 12.1547C8.50909 12.4672 8.3335 12.8911 8.3335 13.3332V17.4998" stroke="#6A6A75" stroke-width="1.5"/>
                                            </svg>
                                        </div>
                                        <div style="font-weight: 400;line-height: 20px;" class="text-[14px]">
                                            {{count($gift->claimStores)}} Cabang
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div>
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                <path d="M13.7858 12L7.82803 6.04688C7.3874 5.60625 7.3874 4.89375 7.82803 4.45781C8.26865 4.02188 8.98115 4.02188 9.42178 4.45781L16.1718 11.2031C16.5983 11.6297 16.6077 12.3141 16.2046 12.7547L9.42647 19.5469C9.20615 19.7672 8.91553 19.875 8.62959 19.875C8.34365 19.875 8.05303 19.7672 7.83272 19.5469C7.39209 19.1062 7.39209 18.3938 7.83272 17.9578L13.7858 12Z" fill="#B1B1B1"/>
                            </svg>
                        </div>
                    </div>
                    @endforeach
                </div>
                <div x-show="showPromotions" class="gap-4">
                    @foreach ($promotions as $promotion)
                    <div wire:click="detailClaim({{$promotion->id}}, 0)" class="flex justify-between items-center p-4 border-b cursor-pointer no-select">
                        <div class="flex items-start gap-2">
                            <div class="w-10 h-10 bg-[#DDF1E2] rounded-full flex items-center justify-center">
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 15 16" fill="none">
                                    <path fill-rule="evenodd" clip-rule="evenodd" d="M6.3257 2.5988C6.49453 2.41024 6.70122 2.25941 6.93229 2.15615C7.16336 2.05289 7.41361 1.99951 7.6667 1.99951C7.91979 1.99951 8.17004 2.05289 8.40111 2.15615C8.63217 2.25941 8.83887 2.41024 9.0077 2.5988L9.4277 3.068C9.48772 3.13514 9.56209 3.18791 9.64528 3.22239C9.72848 3.25688 9.81838 3.27219 9.9083 3.2672L10.5383 3.2324C10.7909 3.21852 11.0436 3.25806 11.28 3.34844C11.5163 3.43881 11.7309 3.57799 11.9098 3.75689C12.0887 3.9358 12.2279 4.15041 12.3183 4.38673C12.4086 4.62305 12.4482 4.87577 12.4343 5.1284L12.3995 5.7584C12.3946 5.84822 12.41 5.938 12.4444 6.02108C12.4789 6.10417 12.5316 6.17844 12.5987 6.2384L13.0685 6.6584C13.2572 6.82723 13.4081 7.03396 13.5114 7.26508C13.6147 7.49621 13.6681 7.74653 13.6681 7.9997C13.6681 8.25286 13.6147 8.50319 13.5114 8.73431C13.4081 8.96543 13.2572 9.17216 13.0685 9.341L12.5987 9.761C12.5316 9.82102 12.4788 9.89539 12.4443 9.97858C12.4098 10.0618 12.3945 10.1517 12.3995 10.2416L12.4343 10.8716C12.4482 11.1242 12.4086 11.3769 12.3183 11.6133C12.2279 11.8496 12.0887 12.0642 11.9098 12.2431C11.7309 12.422 11.5163 12.5612 11.28 12.6516C11.0436 12.7419 10.7909 12.7815 10.5383 12.7676L9.9083 12.7328C9.81847 12.7279 9.7287 12.7432 9.64561 12.7777C9.56253 12.8122 9.48826 12.8649 9.4283 12.932L9.0083 13.4018C8.83947 13.5904 8.63274 13.7414 8.40161 13.8447C8.17049 13.948 7.92017 14.0014 7.667 14.0014C7.41383 14.0014 7.16351 13.948 6.93238 13.8447C6.70126 13.7414 6.49453 13.5904 6.3257 13.4018L5.9057 12.932C5.84568 12.8649 5.77131 12.8121 5.68811 12.7776C5.60491 12.7431 5.51502 12.7278 5.4251 12.7328L4.7951 12.7676C4.54247 12.7815 4.28975 12.7419 4.05343 12.6516C3.81711 12.5612 3.6025 12.422 3.4236 12.2431C3.24469 12.0642 3.10551 11.8496 3.01514 11.6133C2.92476 11.3769 2.88522 11.1242 2.8991 10.8716L2.9339 10.2416C2.9388 10.1518 2.92344 10.062 2.88896 9.97891C2.85448 9.89582 2.80176 9.82155 2.7347 9.7616L2.2655 9.3416C2.07684 9.17276 1.92593 8.96603 1.82261 8.73491C1.71928 8.50379 1.66588 8.25346 1.66588 8.0003C1.66588 7.74713 1.71928 7.49681 1.82261 7.26568C1.92593 7.03456 2.07684 6.82783 2.2655 6.659L2.7347 6.239C2.80184 6.17897 2.85461 6.10461 2.8891 6.02141C2.92358 5.93821 2.93889 5.84832 2.9339 5.7584L2.8991 5.1284C2.88522 4.87577 2.92476 4.62305 3.01514 4.38673C3.10551 4.15041 3.24469 3.9358 3.4236 3.75689C3.6025 3.57799 3.81711 3.43881 4.05343 3.34844C4.28975 3.25806 4.54247 3.21852 4.7951 3.2324L5.4251 3.2672C5.51492 3.2721 5.6047 3.25674 5.68778 3.22226C5.77087 3.18778 5.84514 3.13506 5.9051 3.068L6.3251 2.5988H6.3257ZM9.8909 5.7758C10.0034 5.88831 10.0666 6.0409 10.0666 6.2C10.0666 6.35909 10.0034 6.51168 9.8909 6.6242L6.2909 10.2242C6.17774 10.3335 6.02618 10.394 5.86886 10.3926C5.71154 10.3912 5.56105 10.3281 5.44981 10.2169C5.33856 10.1056 5.27546 9.95515 5.27409 9.79784C5.27273 9.64052 5.3332 9.48896 5.4425 9.3758L9.0425 5.7758C9.15501 5.66331 9.3076 5.60012 9.4667 5.60012C9.6258 5.60012 9.77838 5.66331 9.8909 5.7758ZM6.1667 5.6C5.928 5.6 5.69908 5.69482 5.5303 5.8636C5.36152 6.03238 5.2667 6.2613 5.2667 6.5V6.506C5.2667 6.74469 5.36152 6.97361 5.5303 7.14239C5.69908 7.31118 5.928 7.406 6.1667 7.406H6.1727C6.41139 7.406 6.64031 7.31118 6.80909 7.14239C6.97788 6.97361 7.0727 6.74469 7.0727 6.506V6.5C7.0727 6.2613 6.97788 6.03238 6.80909 5.8636C6.64031 5.69482 6.41139 5.6 6.1727 5.6H6.1667ZM9.1667 8.6C8.928 8.6 8.69908 8.69482 8.5303 8.8636C8.36152 9.03238 8.2667 9.2613 8.2667 9.5V9.506C8.2667 9.74469 8.36152 9.97361 8.5303 10.1424C8.69908 10.3112 8.928 10.406 9.1667 10.406H9.1727C9.41139 10.406 9.64031 10.3112 9.80909 10.1424C9.97788 9.97361 10.0727 9.74469 10.0727 9.506V9.5C10.0727 9.2613 9.97788 9.03238 9.80909 8.8636C9.64031 8.69482 9.41139 8.6 9.1727 8.6H9.1667Z" fill="#2C9854"/>
                                </svg>
                            </div>
                            <div class="gap-1">
                                <div style="font-weight: 600;line-height: 24px;" class="text-[18px] max-w-[350px] truncate">
                                    {{$promotion->title}}
                                </div>
                                <div style="font-weight: 400;line-height: 20px; " class="text-[16px] text-[#6A6A75] max-w-[350px] line-clamp-2">
                                    {{$promotion->description}}
                                </div>
                                <div class="flex items-center gap-5">
                                    <div class="flex items-center gap-[3px]">
                                        <div>
                                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20" fill="none">
                                                <path d="M15.8332 10.8332H4.1665V9.1665H15.8332V10.8332ZM9.99984 4.1665C10.4419 4.1665 10.8658 4.3421 11.1783 4.65466C11.4909 4.96722 11.6665 5.39114 11.6665 5.83317C11.6665 6.2752 11.4909 6.69912 11.1783 7.01168C10.8658 7.32424 10.4419 7.49984 9.99984 7.49984C9.55781 7.49984 9.13389 7.32424 8.82133 7.01168C8.50877 6.69912 8.33317 6.2752 8.33317 5.83317C8.33317 5.39114 8.50877 4.96722 8.82133 4.65466C9.13389 4.3421 9.55781 4.1665 9.99984 4.1665ZM9.99984 12.4998C10.4419 12.4998 10.8658 12.6754 11.1783 12.988C11.4909 13.3006 11.6665 13.7245 11.6665 14.1665C11.6665 14.6085 11.4909 15.0325 11.1783 15.345C10.8658 15.6576 10.4419 15.8332 9.99984 15.8332C9.55781 15.8332 9.13389 15.6576 8.82133 15.345C8.50877 15.0325 8.33317 14.6085 8.33317 14.1665C8.33317 13.7245 8.50877 13.3006 8.82133 12.988C9.13389 12.6754 9.55781 12.4998 9.99984 12.4998Z" fill="#6A6A75"/>
                                            </svg>
                                        </div>
                                        <div style="font-weight: 400;line-height: 20px;" class="text-[14px]">
                                            60 dari 60 tersisa
                                        </div>
                                    </div>
                                    <div class="flex items-center gap-[3px]">
                                        <div>
                                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20" fill="none">
                                                <path d="M14.3754 10.625H10.6254V14.375H14.3754V10.625ZM13.1254 2.5V3.75H6.87539V2.5H5.00039V3.75H4.0625C3.20305 3.75 2.5 4.45305 2.5 5.3125V15.9375C2.5 16.797 3.20305 17.5 4.0625 17.5H15.9379C16.7973 17.5 17.5004 16.797 17.5004 15.9375V5.3125C17.5004 4.45305 16.7973 3.75 15.9379 3.75H15.0004V2.5H13.1254ZM15.9379 15.9375H4.0625V7.65625H15.9379V15.9375Z" fill="#6A6A75"/>
                                            </svg>
                                        </div>
                                        <div style="font-weight: 400;line-height: 20px;" class="text-[14px]">
                                            {{changeDateFormat($promotion->start_date)}} - {{changeDateFormat($promotion->end_date)}}
                                        </div>
                                    </div>
                                    <div class="flex items-center gap-[3px]">
                                        <div>
                                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20" fill="none">
                                                <path d="M2.5 17.5H4.16667M4.16667 17.5H15.8333M4.16667 17.5V7.77333M17.5 17.5H15.8333M15.8333 17.5V7.77333M4.16667 7.77333C4.13551 7.75544 4.10494 7.73654 4.075 7.71667L3.625 7.41667C3.30688 7.20448 3.0714 6.88935 2.95806 6.52414C2.84472 6.15893 2.86041 5.76585 3.0025 5.41083L3.7475 3.5475C3.87124 3.23825 4.0848 2.97318 4.36063 2.78647C4.63647 2.59976 4.96192 2.49998 5.295 2.5H14.705C15.0381 2.49998 15.3635 2.59976 15.6394 2.78647C15.9152 2.97318 16.1288 3.23825 16.2525 3.5475L16.9975 5.41083C17.1396 5.76585 17.1553 6.15893 17.0419 6.52414C16.9286 6.88935 16.6931 7.20448 16.375 7.41667L15.925 7.71667C15.8951 7.73654 15.8645 7.75544 15.8333 7.77333M4.16667 7.77333C4.43587 7.92882 4.7432 8.00591 5.05392 7.99589C5.36464 7.98588 5.66636 7.88916 5.925 7.71667L7.5 6.66667L9.075 7.71667C9.34888 7.8994 9.67075 7.99692 10 7.99692C10.3292 7.99692 10.6511 7.8994 10.925 7.71667L12.5 6.66667L14.075 7.71667C14.3336 7.88916 14.6354 7.98588 14.9461 7.99589C15.2568 8.00591 15.5641 7.92882 15.8333 7.77333" stroke="#6A6A75" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                                <path d="M11.6668 17.4998V13.3332C11.6668 12.8911 11.4912 12.4672 11.1787 12.1547C10.8661 11.8421 10.4422 11.6665 10.0002 11.6665C9.55814 11.6665 9.13421 11.8421 8.82165 12.1547C8.50909 12.4672 8.3335 12.8911 8.3335 13.3332V17.4998" stroke="#6A6A75" stroke-width="1.5"/>
                                            </svg>
                                        </div>
                                        <div style="font-weight: 400;line-height: 20px;" class="text-[14px]">
                                            {{count($promotion->promotionStores)}} Cabang
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div>
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                <path d="M13.7858 12L7.82803 6.04688C7.3874 5.60625 7.3874 4.89375 7.82803 4.45781C8.26865 4.02188 8.98115 4.02188 9.42178 4.45781L16.1718 11.2031C16.5983 11.6297 16.6077 12.3141 16.2046 12.7547L9.42647 19.5469C9.20615 19.7672 8.91553 19.875 8.62959 19.875C8.34365 19.875 8.05303 19.7672 7.83272 19.5469C7.39209 19.1062 7.39209 18.3938 7.83272 17.9578L13.7858 12Z" fill="#B1B1B1"/>
                            </svg>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>

    <div x-cloak x-show="showDetailClaim" style="z-index:100" class="fixed inset-0 w-screen h-screen bg-black bg-opacity-50 flex items-center justify-center">
        <div @click.outside="showDetailClaim=false" class="bg-white dark:bg-dark-secondary h-screen lg:h-auto rounded-sm lg:max-h-screen flex flex-col">
            <div class="px-5 flex-none py-[18px] flex gap-4 items-center no-select border-b">
                <div @click="showDetailClaim=false" class="cursor-pointer">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                        <path d="M13.0594 12.0001L16.2563 8.80322C16.5469 8.5126 16.5469 8.03447 16.2563 7.74385C15.9656 7.45322 15.4875 7.45322 15.1969 7.74385L12 10.9407L8.80313 7.74385C8.5125 7.45322 8.03437 7.45322 7.74375 7.74385C7.59844 7.88916 7.52344 8.08135 7.52344 8.27354C7.52344 8.46572 7.59844 8.65791 7.74375 8.80322L10.9406 12.0001L7.74375 15.197C7.59844 15.3423 7.52344 15.5345 7.52344 15.7267C7.52344 15.9188 7.59844 16.111 7.74375 16.2563C8.03437 16.547 8.5125 16.547 8.80313 16.2563L12 13.0595L15.1969 16.2563C15.4875 16.547 15.9656 16.547 16.2563 16.2563C16.5469 15.9657 16.5469 15.4876 16.2563 15.197L13.0594 12.0001Z" fill="#B1B1B1"/>
                    </svg>
                </div>
                <div style="font-weight: 600;line-height: 20px;" class="text-[16px]">
                    Detail Penawaran
                </div>
            </div>
            <div class="flex-1 overflow-auto lg:overflow-hidden lg:flex hide-scrollbar gap-11">
                <div class="w-full lg:w-[500px] py-6 pl-6 border-b lg:border-b-0">
                    <div class="w-[450px]">
                        <div class="w-full relative">
                            @if($detailClaim)
                            @if($detailClaim->thumbnail_path)
                                <img class="w-[450px] h-[220px]" src="{{env('CUSTOMER_APP_URL') . 'storage/' . $detailClaim->thumbnail_path}}" />
                            @else
                            <div class="w-[450px] h-[220px] mb-8 bg-[#F5F7F9] flex items-center justify-center">
                                <svg xmlns="http://www.w3.org/2000/svg" width="47" height="40" viewBox="0 0 47 40" fill="none">
                                    <path d="M41.0128 31.6666V8.33336C41.0128 6.49984 39.2617 5 37.121 5H9.87884C7.73817 5 5.98706 6.49984 5.98706 8.33336V31.6666C5.98706 33.5002 7.73817 35 9.87884 35H37.121C39.2617 35 41.0128 33.5002 41.0128 31.6666ZM16.6893 22.5L21.5541 27.5L28.3646 20L37.121 30H9.87884L16.6893 22.5Z" fill="#DEE3E9"/>
                                </svg>
                            </div>
                            @endif
                            @endif
                            <div class="absolute top-0 left-0 p-2 flex items-center gap-[6px] bg-white rounded-br-xl">
                                <div class="w-6 h-6 rounded-full {{ $detailClaim ? $is_claim == 1 ? $detailClaim->claim_type_id == 1 ? 'bg-[#E5EDFA]' : 'bg-[#FAE4E4]' : 'bg-[#DDF1E2]' : '' }} flex items-center justify-center">
                                    @if($is_claim == 1)
                                        @if($detailClaim)
                                        @if($detailClaim->claim_type_id == 1)
                                        <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 12 12" fill="none">
                                            <path d="M10.5 2.5H1.5C1.36739 2.5 1.24021 2.55268 1.14645 2.64645C1.05268 2.74021 1 2.86739 1 3V5H1.4465C1.9445 5 2.4065 5.3405 2.4865 5.832C2.51087 5.97552 2.50363 6.12263 2.46528 6.26306C2.42693 6.40349 2.3584 6.53386 2.26447 6.64508C2.17054 6.75629 2.05347 6.84567 1.92143 6.90697C1.7894 6.96827 1.64557 7.00002 1.5 7H1V9C1 9.13261 1.05268 9.25979 1.14645 9.35355C1.24021 9.44732 1.36739 9.5 1.5 9.5H10.5C10.6326 9.5 10.7598 9.44732 10.8536 9.35355C10.9473 9.25979 11 9.13261 11 9V7H10.5C10.3544 7.00002 10.2106 6.96827 10.0786 6.90697C9.94653 6.84567 9.82946 6.75629 9.73553 6.64508C9.6416 6.53386 9.57307 6.40349 9.53472 6.26306C9.49637 6.12263 9.48913 5.97552 9.5135 5.832C9.5935 5.3405 10.0555 5 10.5535 5H11V3C11 2.86739 10.9473 2.74021 10.8536 2.64645C10.7598 2.55268 10.6326 2.5 10.5 2.5ZM5.5 8.5H4.5V7.5H5.5V8.5ZM5.5 6.5H4.5V5.5H5.5V6.5ZM5.5 4.5H4.5V3.5H5.5V4.5Z" fill="#3688EF"/>
                                        </svg>
                                        @else
                                        <svg xmlns="http://www.w3.org/2000/svg" width="13" height="12" viewBox="0 0 13 12" fill="none">
                                            <g clip-path="url(#clip0_617_325)">
                                                <path d="M4.86331 0.964864C3.91831 0.959864 2.99831 1.86986 3.41831 2.99986H1.83331C1.5681 2.99986 1.31374 3.10522 1.12621 3.29276C0.93867 3.48029 0.833313 3.73465 0.833313 3.99986V4.99986C0.833313 5.13247 0.885991 5.25965 0.97976 5.35342C1.07353 5.44719 1.2007 5.49986 1.33331 5.49986H5.83331V3.99986H6.83331V5.49986H11.3333C11.4659 5.49986 11.5931 5.44719 11.6869 5.35342C11.7806 5.25965 11.8333 5.13247 11.8333 4.99986V3.99986C11.8333 3.73465 11.728 3.48029 11.5404 3.29276C11.3529 3.10522 11.0985 2.99986 10.8333 2.99986H9.24831C9.83331 1.36486 7.63331 0.209864 6.61831 1.61986L6.33331 1.99986L6.04831 1.60986C5.73331 1.16486 5.29831 0.969864 4.86331 0.964864ZM4.83331 1.99986C5.27831 1.99986 5.50331 2.53986 5.18831 2.85486C4.87331 3.16986 4.33331 2.94486 4.33331 2.49986C4.33331 2.36726 4.38599 2.24008 4.47976 2.14631C4.57353 2.05254 4.7007 1.99986 4.83331 1.99986ZM7.83331 1.99986C8.27831 1.99986 8.50331 2.53986 8.18831 2.85486C7.87331 3.16986 7.33331 2.94486 7.33331 2.49986C7.33331 2.36726 7.38599 2.24008 7.47976 2.14631C7.57353 2.05254 7.7007 1.99986 7.83331 1.99986ZM1.33331 5.99986V9.99986C1.33331 10.2651 1.43867 10.5194 1.62621 10.707C1.81374 10.8945 2.0681 10.9999 2.33331 10.9999H10.3333C10.5985 10.9999 10.8529 10.8945 11.0404 10.707C11.228 10.5194 11.3333 10.2651 11.3333 9.99986V5.99986H6.83331V9.99986H5.83331V5.99986H1.33331Z" fill="#FE5C5C"/>
                                            </g>
                                            <defs>
                                                <clipPath id="clip0_617_325">
                                                    <rect width="12" height="12" fill="white" transform="translate(0.333313)"/>
                                                </clipPath>
                                            </defs>
                                        </svg>
                                        @endif
                                        @endif
                                    @else
                                        <svg xmlns="http://www.w3.org/2000/svg" width="15" height="16" viewBox="0 0 15 16" fill="none">
                                            <path fill-rule="evenodd" clip-rule="evenodd" d="M6.3257 2.5988C6.49453 2.41024 6.70122 2.25941 6.93229 2.15615C7.16336 2.05289 7.41361 1.99951 7.6667 1.99951C7.91979 1.99951 8.17004 2.05289 8.40111 2.15615C8.63217 2.25941 8.83887 2.41024 9.0077 2.5988L9.4277 3.068C9.48772 3.13514 9.56209 3.18791 9.64528 3.22239C9.72848 3.25688 9.81838 3.27219 9.9083 3.2672L10.5383 3.2324C10.7909 3.21852 11.0436 3.25806 11.28 3.34844C11.5163 3.43881 11.7309 3.57799 11.9098 3.75689C12.0887 3.9358 12.2279 4.15041 12.3183 4.38673C12.4086 4.62305 12.4482 4.87577 12.4343 5.1284L12.3995 5.7584C12.3946 5.84822 12.41 5.938 12.4444 6.02108C12.4789 6.10417 12.5316 6.17844 12.5987 6.2384L13.0685 6.6584C13.2572 6.82723 13.4081 7.03396 13.5114 7.26508C13.6147 7.49621 13.6681 7.74653 13.6681 7.9997C13.6681 8.25286 13.6147 8.50319 13.5114 8.73431C13.4081 8.96543 13.2572 9.17216 13.0685 9.341L12.5987 9.761C12.5316 9.82102 12.4788 9.89539 12.4443 9.97858C12.4098 10.0618 12.3945 10.1517 12.3995 10.2416L12.4343 10.8716C12.4482 11.1242 12.4086 11.3769 12.3183 11.6133C12.2279 11.8496 12.0887 12.0642 11.9098 12.2431C11.7309 12.422 11.5163 12.5612 11.28 12.6516C11.0436 12.7419 10.7909 12.7815 10.5383 12.7676L9.9083 12.7328C9.81847 12.7279 9.7287 12.7432 9.64561 12.7777C9.56253 12.8122 9.48826 12.8649 9.4283 12.932L9.0083 13.4018C8.83947 13.5904 8.63274 13.7414 8.40161 13.8447C8.17049 13.948 7.92017 14.0014 7.667 14.0014C7.41383 14.0014 7.16351 13.948 6.93238 13.8447C6.70126 13.7414 6.49453 13.5904 6.3257 13.4018L5.9057 12.932C5.84568 12.8649 5.77131 12.8121 5.68811 12.7776C5.60491 12.7431 5.51502 12.7278 5.4251 12.7328L4.7951 12.7676C4.54247 12.7815 4.28975 12.7419 4.05343 12.6516C3.81711 12.5612 3.6025 12.422 3.4236 12.2431C3.24469 12.0642 3.10551 11.8496 3.01514 11.6133C2.92476 11.3769 2.88522 11.1242 2.8991 10.8716L2.9339 10.2416C2.9388 10.1518 2.92344 10.062 2.88896 9.97891C2.85448 9.89582 2.80176 9.82155 2.7347 9.7616L2.2655 9.3416C2.07684 9.17276 1.92593 8.96603 1.82261 8.73491C1.71928 8.50379 1.66588 8.25346 1.66588 8.0003C1.66588 7.74713 1.71928 7.49681 1.82261 7.26568C1.92593 7.03456 2.07684 6.82783 2.2655 6.659L2.7347 6.239C2.80184 6.17897 2.85461 6.10461 2.8891 6.02141C2.92358 5.93821 2.93889 5.84832 2.9339 5.7584L2.8991 5.1284C2.88522 4.87577 2.92476 4.62305 3.01514 4.38673C3.10551 4.15041 3.24469 3.9358 3.4236 3.75689C3.6025 3.57799 3.81711 3.43881 4.05343 3.34844C4.28975 3.25806 4.54247 3.21852 4.7951 3.2324L5.4251 3.2672C5.51492 3.2721 5.6047 3.25674 5.68778 3.22226C5.77087 3.18778 5.84514 3.13506 5.9051 3.068L6.3251 2.5988H6.3257ZM9.8909 5.7758C10.0034 5.88831 10.0666 6.0409 10.0666 6.2C10.0666 6.35909 10.0034 6.51168 9.8909 6.6242L6.2909 10.2242C6.17774 10.3335 6.02618 10.394 5.86886 10.3926C5.71154 10.3912 5.56105 10.3281 5.44981 10.2169C5.33856 10.1056 5.27546 9.95515 5.27409 9.79784C5.27273 9.64052 5.3332 9.48896 5.4425 9.3758L9.0425 5.7758C9.15501 5.66331 9.3076 5.60012 9.4667 5.60012C9.6258 5.60012 9.77838 5.66331 9.8909 5.7758ZM6.1667 5.6C5.928 5.6 5.69908 5.69482 5.5303 5.8636C5.36152 6.03238 5.2667 6.2613 5.2667 6.5V6.506C5.2667 6.74469 5.36152 6.97361 5.5303 7.14239C5.69908 7.31118 5.928 7.406 6.1667 7.406H6.1727C6.41139 7.406 6.64031 7.31118 6.80909 7.14239C6.97788 6.97361 7.0727 6.74469 7.0727 6.506V6.5C7.0727 6.2613 6.97788 6.03238 6.80909 5.8636C6.64031 5.69482 6.41139 5.6 6.1727 5.6H6.1667ZM9.1667 8.6C8.928 8.6 8.69908 8.69482 8.5303 8.8636C8.36152 9.03238 8.2667 9.2613 8.2667 9.5V9.506C8.2667 9.74469 8.36152 9.97361 8.5303 10.1424C8.69908 10.3112 8.928 10.406 9.1667 10.406H9.1727C9.41139 10.406 9.64031 10.3112 9.80909 10.1424C9.97788 9.97361 10.0727 9.74469 10.0727 9.506V9.5C10.0727 9.2613 9.97788 9.03238 9.80909 8.8636C9.64031 8.69482 9.41139 8.6 9.1727 8.6H9.1667Z" fill="#2C9854"/>
                                        </svg>
                                    @endif
                                </div>
                                <div style="font-weight: 400;line-height: 20px;" class="text-[16px]">
                                    @if($is_claim == 1)
                                        @if($detailClaim)
                                        {{ $detailClaim->claim_type_id == 1 ? "Voucher" : "Hadiah" }}
                                        @endif
                                    @else
                                        Promo
                                    @endif
                                </div>
                            </div>
                        </div>

                        <div class="mb-8">
                            <div style="font-weight: 600;" class="h-6 flex items-center text-[20px] mb-2 truncate">
                                {{$detailClaim ? $detailClaim->title : "-"}}
                            </div>
                            <div style="font-weight: 400;" class="text-[16px] text-[#6A6A75] line-clamp-2">
                                {{$detailClaim ? $detailClaim->description : "-"}}
                            </div>
                        </div>

                        <div class="p-3 rounded-sm border gap-5">
                            <div class="flex items-center justify-between mb-5">
                                <div style="font-weight: 400;line-height: 20px;" class="text-[16px] text-[#6A6A75]">
                                    Ditukar
                                </div>
                                <div style="font-weight: 400;line-height: 20px; " class="text-[16px]">
                                    {{$detailClaim ? changeDateFormat($detailClaim->created_at) : "-"}}
                                </div>
                            </div>
                            <div class="flex items-center justify-between mb-5">
                                <div style="font-weight: 400;line-height: 20px;" class="text-[16px] text-[#6A6A75]">
                                    Hangus dalam
                                </div>
                                <div style="font-weight: 400;line-height: 20px; " class="text-[16px] text-[#FF8933]">
                                    @if($detailClaim)
                                    {{readableDaysLeft($detailClaim->end_date)}}
                                    @endif
                                </div>
                            </div>
                            @if($is_claim == 1)
                            <div class="flex items-center justify-between">
                                <div style="font-weight: 400;line-height: 20px;" class="text-[16px] text-[#6A6A75]">
                                    Nilai Tukar
                                </div>
                                <div style="font-weight: 400;line-height: 20px; " class="text-[16px]">
                                    <div class="px-2 py-1 border rounded-full flex items-center gap-1">
                                        <div>
                                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20" fill="none">
                                                <path d="M10.0042 18.3356C5.40167 18.3356 1.67084 14.6048 1.67084 10.0023C1.67084 5.39978 5.40167 1.66895 10.0042 1.66895C14.6067 1.66895 18.3375 5.39978 18.3375 10.0023C18.3375 14.6048 14.6067 18.3356 10.0042 18.3356ZM10.0042 6.46644L6.46834 10.0023L10.0042 13.5381L13.5392 10.0023L10.0042 6.46644Z" fill="#FFA858"/>
                                                <path fill-rule="evenodd" clip-rule="evenodd" d="M10.0041 5.28835L14.7175 10.0028L10.0041 14.7172L5.28973 10.0028L10.0041 5.28835ZM2.50408 10.0028C2.50408 14.145 5.86182 17.5028 10.0041 17.5028C14.1463 17.5028 17.5041 14.145 17.5041 10.0028C17.5041 5.8605 14.1463 2.50277 10.0041 2.50277C5.86182 2.50277 2.50408 5.8605 2.50408 10.0028ZM6.46825 10.0028L10.0041 6.46693L13.5391 10.0028L10.0041 13.5386L6.46825 10.0028ZM1.67075 10.0028C1.67075 14.6053 5.40158 18.3361 10.0041 18.3361C14.6066 18.3361 18.3374 14.6053 18.3374 10.0028C18.3374 5.40027 14.6066 1.66943 10.0041 1.66943C5.40158 1.66943 1.67075 5.40027 1.67075 10.0028Z" fill="#DF812B"/>
                                            </svg>
                                        </div>
                                        <div style="font-weight: 400;line-height: 20px;" class="text-[14px]">
                                            {{$detailClaim ? $detailClaim->exchange_rate : '0'}} pts
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endif
                        </div>
                    </div>
                </div>
                <div class='w-full lg:max-w-[500px] py-6 pr-6 flex flex-col justify-between'>
                    <div class="">
                        <div style="font-weight: 600;line-height: 24px;" class="text-[18px]">
                            Penukaran dapat di lakukan di cabang :
                        </div>
                        <div class="max-w-[370px] max-h-[325px] overflow-auto hide-scrollbar">
                            @foreach($allStores as $store)
                            <div class="flex gap-2 py-3 border-b">
                                <div>
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                        <path d="M15.75 4.50019C15.7499 3.79065 15.5486 3.09568 15.1693 2.49601C14.79 1.89634 14.2484 1.41658 13.6074 1.11245C12.9663 0.808312 12.2521 0.692291 11.5478 0.777859C10.8434 0.863427 10.1778 1.14707 9.62818 1.59585C9.07859 2.04462 8.66759 2.64011 8.44293 3.31315C8.21828 3.98619 8.18917 4.70915 8.359 5.39807C8.52884 6.08699 8.89063 6.71358 9.40237 7.20508C9.91411 7.69659 10.5548 8.03282 11.25 8.17472V21.4483C11.2501 21.6476 11.2898 21.8448 11.3667 22.0286L11.8388 23.1536C11.8546 23.1826 11.8779 23.2067 11.9063 23.2236C11.9346 23.2404 11.967 23.2493 12 23.2493C12.033 23.2493 12.0654 23.2404 12.0937 23.2236C12.1221 23.2067 12.1454 23.1826 12.1613 23.1536L12.6333 22.0286C12.7102 21.8448 12.7499 21.6476 12.75 21.4483V8.17472C13.5964 8.00078 14.357 7.54032 14.9035 6.87096C15.4499 6.20161 15.7489 5.3643 15.75 4.50019ZM13.125 4.50019C12.9025 4.50019 12.685 4.43421 12.5 4.3106C12.315 4.18698 12.1708 4.01128 12.0856 3.80571C12.0005 3.60015 11.9782 3.37395 12.0216 3.15572C12.065 2.93749 12.1722 2.73703 12.3295 2.5797C12.4868 2.42236 12.6873 2.31522 12.9055 2.27181C13.1238 2.2284 13.35 2.25068 13.5555 2.33583C13.7611 2.42098 13.9368 2.56517 14.0604 2.75018C14.184 2.93518 14.25 3.15269 14.25 3.37519C14.25 3.67356 14.1315 3.95971 13.9205 4.17069C13.7095 4.38167 13.4234 4.50019 13.125 4.50019Z" fill="#FE5C5C"/>
                                    </svg>
                                </div>
                                <div class="">
                                    <div style="font-weight: 600;line-height: 20px" class="mb-2 text-[16px] line-clamp-1">
                                        {{$store->store->name}}
                                    </div>
                                    <div style="font-weight: 400;line-height: 20px; " class="text-[14px] text-[#6A6A75] line-clamp-2">
                                        {{$store->store->address}}, {{$store->store->urban_village}}, {{$store->store->subdistrict}}, {{$store->store->city}}, {{$store->store->province}} ({{$store->store->postal_code}})
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                    <div class="p-4 bg-[#F5F7F9] flex justify-between items-center">
                        <div class="max-w-[300px]">
                            <div style="font-weight: 600;line-height: 24px;" class="mb-1 text-[18px]">
                                Status Penawaran
                            </div>
                            <div style="font-weight: 400;line-height: 20px;" class="text-[14px] text-[#6A6A75]">
                                Aktifkan/nonaktifkan penawaran dari system dengan klik toggle di kanan
                            </div>
                        </div>
                        <div>
                            <div wire:click="changeStatusClaim" class="flex h-5 w-9 cursor-pointer items-center rounded-full p-1 dark:bg-dark-secondary {{ $statusClaim ? 'bg-primary' : 'bg-gray-400'}}">
                                <div class="toggle-circle h-4 w-4 rounded-full bg-white transition duration-300 {{ $statusClaim ? 'translate-x-3' : ''}} ease-in-out">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="flex items-center justify-end px-6 py-3 bg-[#F9FAFB]" >
                <div @click="showDetailClaim=false" style="font-weight: 600;line-height: 20px;" class="p-3 flex items-center justify-center text-primary text-[16px] mr-6 no-select cursor-pointer">
                    Batal
                </div>
                <div @click="showEditClaimConfirm=true" class="h-[44px] flex items-center justify-center p-3 bg-primary rounded-sm no-select cursor-pointer">
                    <div style="font-weight: 600;" class="h-5 flex items-center text-white text-[16px]">
                        Simpan
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div x-cloak x-show="showEditClaimConfirm" class="bg-black bg-opacity-50 w-screen h-screen fixed top-0 left-0 z-[100] flex items-center justify-center">
        <div class="w-screen md:w-full md:max-w-md max-w-full rounded-sm bg-white">
            <div class="p-6">
                <div class="mt-5">
                    <div style="font-weight: 600;" class="mb-[2px] text-[16px] text-dark-primary dark:text-white">
                        Apakah anda yakin?
                    </div>
                    <div style="font-weight: 400;" class="text-[14px] text-[#6A6A75] dark:text-white">
                        Dengan memilih konfirmasi, anda menyimpan perubahan yang sudah anda lakukan
                    </div>
                </div>
            </div>
            <div class="px-6 py-3 flex justify-end w-full gap-[14px] bg-[#F9FAFB]">
                <div @click="showEditClaimConfirm=false" style="font-weight: 600;line-height: 20px;" class="p-3 text-[16px] flex items-center cursor-pointer justify-center rounded-sm text-primary dark:border-none">
                    Cek Kembali
                </div>
                <div wire:click="saveClaim" style="font-weight: 600;line-height: 20px;" class="p-3 text-[16px] flex items-center cursor-pointer justify-center rounded-sm text-white border border-[#D6DADF] dark:border-none bg-primary">
                    Konfirmasi
                </div>
            </div>
        </div>
    </div>

    <script src="{{ asset('src/js/selectAll.js') }}"></script>
    <script src="{{ asset('src/js/formatRupiah.js') }}"></script>
    <script src="{{ asset('src/js/onlyNumber.js') }}"></script>
</div>
