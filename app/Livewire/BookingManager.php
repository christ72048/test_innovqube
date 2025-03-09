<?php

namespace App\Livewire;
use App\Models\Bookings;
use App\Models\Properties;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;
class BookingManager extends Component
{

    public $properties;
    public $selectedProperty = null;
    public $start_date;
    public $end_date;
    public $user_bookings =null;

    public function mount()
    {
        // Charger toutes les propriétés
        $this->properties = Properties::all();
        
    }

   public function selectProperty($propertyId)
    {
        // Sélectionner une propriété pour la réservation
        $this->selectedProperty = Properties::find($propertyId);
    }

    public function book($propertyId)
    {
        // Validation du formulaire
        $this->validate([
            'start_date' => 'required|date|after_or_equal:today',
            'end_date' => 'required|date|after:start_date',
        ]);
     

        if (!auth()->check()) {
            // Stocke la propriété sélectionnée dans la session
            session()->put('selected_property', $propertyId);
            
            // Redirige l'utilisateur vers la page de connexion
            return redirect()->route('login');
        }
        // Création de la réservation
        Bookings::create([
            'user_id' => auth::id(),
            'property_id' => $this->selectedProperty->id,
            'start_date' => $this->start_date,
            'end_date' => $this->end_date,
        ]);

        // Réinitialiser après réservation
        $this->reset(['selectedProperty', 'start_date', 'end_date']);
        session()->flash('message', 'Réservation confirmée !');
    }
    //Mettre la selectedProperty a null pour revenir a la liste des biens immobiliers
    public function resetSelection(){
        $this->selectedProperty = null;
        $this->dispatch('$refresh'); 
    
    }

    //Recupérer les réservations de l'utilisateur connecte
    public function userBookings(){
        $this->user_bookings = Bookings::where('user_id', Auth::id())->get();
    }

    
    public function render()
    {
        return view('livewire.booking-manager');
    }
}
