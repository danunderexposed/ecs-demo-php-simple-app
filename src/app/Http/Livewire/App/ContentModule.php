<?php

namespace App\Http\Livewire\App;

use Livewire\Component;
use App\Utilities\LookupVideo;

class ContentModule extends Component
{
    public $type, $index, $values, $showVideoModal, $videoId;
    public $newVideoUrl = "";
    public $listeners = ['updateInput'];
    public $customValues = [];

    public function updated()
    {
        $values = array_merge($this->values, $this->customValues);
       // dd($values);
        $this->emit('updateContentModule', ['values' => $values, 'index' => $this->index]);
    }

    public function render()
    {
        return view('livewire.app.content-module');
    }

    public function updateInput($value, $inputName)
    {
        $this->customValues[$inputName] = $value;
        $this->updated();
    }

    public function showVideoModal($id)
    {
        $this->showVideoModal = true;
        $this->newVideoUrl = "";
    }

    public function storeVideo()
    {
        $newVideo = [
            'vimeo_url' => $this->newVideoUrl,
        ];

        if (isset($this->values['videos'])){
            $this->values['videos'][] = $newVideo;
        } else {
            $this->values['videos'] = [
                $newVideo
            ];
        }
        $this->showVideoModal = false;
        $this->updated();
    }

    public function updateVideoOrder($order)
    {
        //dd($order);
        $videos = $this->values['videos'];
        //dd($videos);
        $newOrder = [];
        foreach ($order as $o){
            foreach ($videos as $index => $v){
                if ($index == $o['value']){
                    $newOrder[] = $v;
                    break;
                }
            }
        }
       // dd($newOrder);
        $this->values['videos'] = $newOrder;
        $this->updated();
    }

    public function removeVideo($index)
    {
        unset($this->values['videos'][$index]);
        $this->updated();
    }

    public function debug() {
        dd(array_merge($this->values, $this->customValues));
    }

}
