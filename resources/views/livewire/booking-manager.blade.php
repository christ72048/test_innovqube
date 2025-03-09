<div>
<div class="p-4 bg-white shadow rounded">
    <div class="max-w-3xl mx-auto p-6 bg-white shadow-md rounded-lg">
        <h2 class="text-xl font-bold mb-4">Réserver une propriété</h2>
    
        <!-- Affichage des propriétés -->
        @if (!$selectedProperty)
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                @foreach($properties as $property)
                    <div class="bg-gray-100 p-4 rounded-lg shadow-md">
                        <h3 class="font-bold text-lg">{{ $property->name }}</h3>
                        <p class="text-gray-600">{{ $property->description }}</p>
                        <p class="text-blue-600 font-semibold">{{ $property->price_per_night }}€ / nuit</p>
                        <button wire:click="selectProperty({{ $property->id }})" 
                            class="mt-2 bg-blue-600 text-black px-4 py-2 rounded">
                            Réserver
                        </button>
                    </div>
                @endforeach
            </div>
        @else
            <!-- Formulaire de réservation -->
            <div>
                <button wire:click="resetSelection" class="text-red-600 mb-4">
                    ← Retour aux propriétés
                </button>
                <h3 class="text-lg font-bold">{{ $selectedProperty->name }}</h3>
                <p class="text-gray-600">{{ $selectedProperty->description }}</p>
                <p class="text-blue-600 font-semibold">{{ $selectedProperty->price_per_night }}€ / nuit</p>
    
                <label class="block mt-4 font-semibold">Date de début</label>
                <input type="date" wire:model="start_date" class="w-full border p-2 rounded">
    
                <label class="block mt-2 font-semibold">Date de fin</label>
                <input type="date" wire:model="end_date" class="w-full border p-2 rounded">
                <button wire:click="book({{ $selectedProperty->id }})" class="mt-3 bg-green-600 text-black px-4 py-2 rounded">
                    Confirmer la réservation
                </button>
            </div>
        @endif
    
        <!-- Message de confirmation -->
        @if (session()->has('message'))
            <div class="mt-4 p-2 bg-green-200 text-green-800 rounded">
                {{ session('message') }}
            </div>
        @endif
    </div>
    
</div>

</div>
