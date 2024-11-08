<x-layout>
    @section('content')
    <div 
        class="min-h-screen flex items-center justify-center bg-cover bg-center relative text-white"
        style="background-image: url('{{ Vite::asset('resources/images/ReservationBackground.jpg') }}'); background-size: cover; background-position: center;">
        
        <!-- Overlay -->
        <div class="absolute inset-0 bg-black opacity-60 z-0"></div>
        
        <!-- Content -->
        <div class="relative z-10 bg-white bg-opacity-90 p-8 rounded-lg shadow-lg max-w-3xl mx-auto">
            <h1 class="text-3xl font-bold mb-6 text-center text-gray-900">Napravi rezervaciju</h1>
            <form @submit.prevent="submitForm" method="POST" action="{{ route('reservations.store') }}">
                @csrf
                <input type="hidden" name="service" :value="selectedService">
                <input type="hidden" name="barber" :value="selectedBarber">
                <input type="hidden" name="date" :value="selectedDate">
                <input type="hidden" name="time" :value="selectedTime">
            
            <div x-data="{
                step: 1,
                selectedService: 'fade',
                selectedBarber: null,
                selectedDate: '',
                selectedTime: '',
                errors: {},
                successMessage: '',
                showSuccessMessage: false,
                showErrorMessages: false,
            
                async submitForm() {
    try {
        this.errors = {}; // Očisti prethodne greške
        this.successMessage = ''; // Očisti prethodne uspješne poruke
        this.showSuccessMessage = false;
        this.showErrorMessages = false;

        const response = await fetch('{{ route('reservations.store') }}', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
            },
            body: JSON.stringify({
                service: this.selectedService,
                barber: this.selectedBarber,
                date: this.selectedDate,
                time: this.selectedTime,
            }),
        });

        const data = await response.json();
        if (!response.ok) throw data; // Obrada grešaka validacije

        console.log(data); // Dodaj console.log za dijagnostiku
        this.successMessage = data.message; // Postavljanje poruke uspjeha
        console.log(this.successMessage); // Provjeri ispravnost uspješne poruke
        this.showSuccessMessage = true;
        this.step = 1; // Resetiranje forme

        setTimeout(() => {
            this.showSuccessMessage = false; // Sakrij poruku nakon 3 sekunde
        }, 3000);

    } catch (error) {
        this.errors = error.errors || {};
        this.showErrorMessages = true;

        setTimeout(() => {
            this.showErrorMessages = false; // Sakrij greške nakon 3 sekunde
        }, 3000);
    }
}
            }">
                <!-- First Card -->
                <div x-show="step === 1" class="p-4 md:p-6 lg:p-8 transition-all duration-500">
                    <h2 class="text-lg md:text-xl lg:text-2xl font-bold text-black">Odaberite vrstu usluge</h2>
                    <form class="mt-4">
                        <!-- Service Options -->
                        <div class="mb-2">
                            <label class="inline-flex items-center">
                                <input type="radio" class="form-radio h-5 w-5 text-orange-600" name="service" value="classic" x-model="selectedService" />
                                <span class="ml-2 text-gray-700 text-sm md:text-base lg:text-lg">Klasično šišanje - 10KM</span>
                            </label>
                        </div>
                        <div class="mb-2">
                            <label class="inline-flex items-center">
                                <input type="radio" class="form-radio h-5 w-5 text-orange-600" name="service" value="fade" x-model="selectedService" />
                                <span class="ml-2 text-gray-700 text-sm md:text-base lg:text-lg">Šišanje sa fade-om - 15KM</span>
                            </label>
                        </div>
                        <div class="mb-2">
                            <label class="inline-flex items-center">
                                <input type="radio" class="form-radio h-5 w-5 text-orange-600" name="service" value="machine" x-model="selectedService" />
                                <span class="ml-2 text-gray-700 text-sm md:text-base lg:text-lg">Šišanje mašinicom sve na istu dužinu - 15KM</span>
                            </label>
                        </div>
                        <div class="mb-2">
                            <label class="inline-flex items-center">
                                <input type="radio" class="form-radio h-5 w-5 text-orange-600" name="service" value="shave" x-model="selectedService" />
                                <span class="ml-2 text-gray-700 text-sm md:text-base lg:text-lg">Brijanje brade brivom ili mašinicom - 15KM</span>
                            </label>
                        </div>
                        <div class="mb-2">
                            <label class="inline-flex items-center">
                                <input type="radio" class="form-radio h-5 w-5 text-orange-600" name="service" value="classic_shave" x-model="selectedService" />
                                <span class="ml-2 text-gray-700 text-sm md:text-base lg:text-lg">Klasično šišanje + brijanje - 10KM</span>
                            </label>
                        </div>
                        <div class="mb-2">
                            <label class="inline-flex items-center">
                                <input type="radio" class="form-radio h-5 w-5 text-orange-600" name="service" value="fade_shave" x-model="selectedService" />
                                <span class="ml-2 text-gray-700 text-sm md:text-base lg:text-lg">Šišanje s fade-om + brijanje - 15KM</span>
                            </label>
                        </div>
                        <div class="mt-6 flex justify-between">
                            <!-- "Dalje" button -->
                            <button type="button" @click="step = 2" class="w-full bg-orange-600 text-white py-2 rounded-md hover:bg-orange-500 text-sm md:text-base lg:text-lg">Dalje</button>
                        </div>
                    </form>
                </div>
            
                <!-- Second Card -->
                <div x-show="step === 2" class="p-4 md:p-6 lg:p-8 transition-all duration-500">
                    <h2 class="text-lg md:text-xl lg:text-2xl font-bold text-black">Odaberite svog frizera</h2>
                    <div class="mt-4 space-y-4">
                        <!-- Barber Options and buttons -->
                        <div class="flex items-center justify-between">
                            <div class="flex items-center">
                                <img src={{Vite::asset('resources/images/Barber.jpg')}} alt="Barber 1" class="h-10 w-10 rounded-full">
                                <div class="ml-3">
                                    <p class="text-gray-900 text-sm md:text-base lg:text-lg font-semibold">Petar Petrović</p>
                                    <p class="text-gray-500 text-xs md:text-sm">Frizer</p>
                                </div>
                            </div>
                            <button type="button" @click="selectedBarber = 'Petar Petrović'; step = 3" class="text-orange-600">
                                <svg class="h-6 w-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" />
                                </svg>
                            </button>
                        </div>
                        <div class="flex items-center justify-between">
                            <div class="flex items-center">
                                <img src={{Vite::asset('resources/images/Barber.jpg')}} alt="Barber 1" class="h-10 w-10 rounded-full">
                                <div class="ml-3">
                                    <p class="text-gray-900 text-sm md:text-base lg:text-lg font-semibold">Ivan Petrović</p>
                                    <p class="text-gray-500 text-xs md:text-sm">Frizer</p>
                                </div>
                            </div>
                            <button type="button" @click="selectedBarber = 'Ivan Petrović'; step = 3" class="text-orange-600">
                                <svg class="h-6 w-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" />
                                </svg>
                            </button>
                        </div>
                        <div class="flex items-center justify-between">
                            <div class="flex items-center">
                                <img src={{Vite::asset('resources/images/Barber.jpg')}} alt="Barber 1" class="h-10 w-10 rounded-full">
                                <div class="ml-3">
                                    <p class="text-gray-900 text-sm md:text-base lg:text-lg font-semibold">Krešimir Petrović</p>
                                    <p class="text-gray-500 text-xs md:text-sm">Frizer</p>
                                </div>
                            </div>
                            <button type="button" @click="selectedBarber = 'Krešimir Petrović'; step = 3" class="text-orange-600">
                                <svg class="h-6 w-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" />
                                </svg>
                            </button>
                        </div>
                        <!-- Repeat for other barbers -->
                        <div class="flex justify-center mt-4">
                            <button type="button" @click="selectedBarber = 'first available'; step = 3" class="bg-orange-600 text-white py-2 px-4 rounded-md hover:bg-orange-500 text-sm md:text-base lg:text-lg">Prvi slobodan</button>
                        </div>
                        <!-- Back Button -->
                        <div class="mt-6 flex justify-between">
                            <!-- Back button -->
                            <button type="button" @click="step = 1" class="w-full bg-orange-600 text-white py-2 rounded-md hover:bg-orange-500 text-sm md:text-base lg:text-lg">Nazad</button>
                        </div>
                    </div>
                </div>
            
                <!-- Third Card -->
                <div x-show="step === 3" class="p-4 md:p-6 lg:p-8 transition-all duration-500">
                    <h2 class="text-lg md:text-xl lg:text-2xl font-bold text-black">Odaberite datum i vrijeme</h2>
                    <form class="mt-4">
                        <div class="mb-4">
                            <label class="block text-gray-700 text-sm md:text-base lg:text-lg font-bold mb-2">Datum:</label>
                            <input type="date" x-model="selectedDate" class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm text-sm md:text-base lg:text-lg focus:outline-none focus:ring-orange-500 focus:border-orange-500 text-black bg-white">
                        </div>
                        <div class="mb-4">
                            <label class="block text-gray-700 text-sm md:text-base lg:text-lg font-bold mb-2">Vrijeme:</label>
                            <select x-model="selectedTime" class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm text-sm md:text-base lg:text-lg focus:outline-none focus:ring-orange-500 focus:border-orange-500 text-black bg-white">
                                <option value="" disabled selected>Select Time</option>
                                @php
                                    $start = new DateTime('09:00');
                                    $end = new DateTime('17:00');
                                    $interval = new DateInterval('PT30M'); // 30-minute interval
                                    $times = new DatePeriod($start, $interval, $end);
                                @endphp
                                
                                @foreach ($times as $time)
                                    @php
                                        $formattedTime = $time->format('H:i');
                                    @endphp
                                    <option value="{{ $formattedTime }}" @if(in_array($formattedTime, $reservations)) disabled @endif>
                                        {{ $formattedTime }} @if(in_array($formattedTime, $reservations)) (Zauzeto) @endif
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mt-6 flex justify-between">
                            <button type="button" @click="step = 2" class="w-full bg-orange-600 text-white py-2 rounded-md hover:bg-orange-500 text-sm md:text-base lg:text-lg">Nazad</button>
                            <!-- Final "Rezerviraj" button -->
                            <button type="button" @click="submitForm()" class="w-full bg-orange-600 text-white py-2 rounded-md hover:bg-orange-500 text-sm md:text-base lg:text-lg ml-2">Rezerviraj</button>
                        </div>
                    </form>
                </div>

         <!-- Form fields go here -->
         <template x-if="showSuccessMessage && successMessage">
    <div x-data="{ show: true }" x-init="setTimeout(() => show = false, 3000)" 
         x-show="show" 
         x-transition.opacity.out.duration.500ms 
         class="bg-green-100 text-green-700 p-2 rounded-md mt-4">
        <p x-text="successMessage"></p>
    </div>
</template>

        

        <!-- Error Messages -->
        <template x-if="showErrorMessages && Object.keys(errors).length">
            <div x-data="{ show: true }" x-init="setTimeout(() => show = false, 3000)" x-show="show" x-transition.opacity.out.duration.500ms class="bg-red-100 text-red-700 p-2 rounded-md mt-4">
                <ul>
                    <template x-for="(error, field) in errors" :key="field">
                        <li x-text="error[0]"></li>
                    </template>
                </ul>
            </div>
        </template>
    </form>
</div>
</div>
</x-layout>
