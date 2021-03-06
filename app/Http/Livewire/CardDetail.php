<?php

namespace App\Http\Livewire;

use App\Card;
use Livewire\Component;

class CardDetail extends Component
{
    const DEFAULT_ERROR_MESSAGE = "Oops - you cant do that.";
    public $ulid = '';
    public $mode = 'read';
    public $editTitle = '';
    public $editBody = '';
    public $editSource = '';
    public $editPageNumber = '';
    public $errorMessage = '';
    public $card;
    protected $listeners = [
        'cardSelected' => 'selectCardByUlid',
        'requestCardClosure' => 'closeCard',
        'requestReadMode' => 'enterReadMode'
    ];

    public function mount()
    {
        $this->selectCardByUlid(request()->get('card'));
    }

    public function render()
    {
        return view('livewire.card-detail')
            ->with('card', $this->card);
    }

    public function selectCardByUlid($ulid)
    {
        $this->ulid = $ulid;
        $this->card = Card::findByUlid($this->ulid);
        if ($this->card) {
            $this->emit('openCard', $this->card->ulid);
        }
    }

    public function closeCard()
    {
        $this->emit('closeCard', $this->ulid);
        $this->ulid = '';
        $this->card = null;
    }

    public function enterEditMode()
    {
        $this->editTitle = $this->card->title;
        $this->editBody = $this->card->body;
        $this->editSource = $this->card->source;
        $this->editPageNumber = $this->card->source_pages;
        $this->mode = 'edit';
    }

    public function enterReadMode()
    {
        $this->mode = 'read';
        $this->setErrorMessage('');
    }

    public function updateCard()
    {
        $this->setErrorMessage('');

        if (auth()->user()->can('update', $this->card)) {
            $this->card->title = $this->editTitle;
            $this->card->body = $this->editBody;
            $this->card->source = $this->editSource;
            $this->card->source_pages = $this->editPageNumber;
            $this->card->save();

            $this->emit('card.updated', $this->card->ulid);

            $this->enterReadMode();
        } else {
            $this->errorMessage = self::DEFAULT_ERROR_MESSAGE;
        }
    }

    protected function setErrorMessage($message = '')
    {
        $this->errorMessage = $message;
    }

    public function deleteCard()
    {
        if (auth()->user()->can('delete', $this->card)) {
            $this->card->delete();

            $this->emit('card.deleted', $this->card->ulid);

            $this->closeCard();
        } else {
            $this->errorMessage = self::DEFAULT_ERROR_MESSAGE;
        }
    }
}
