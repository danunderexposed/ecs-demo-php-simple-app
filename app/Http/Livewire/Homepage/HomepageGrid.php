<?php

namespace App\Http\Livewire\Homepage;

use App\Models\Option;
use Livewire\Component;
use App\Models\Homepage;
use WireUi\Traits\Actions;

class HomepageGrid extends Component
{
    use Actions;

    public $homepageGrid, $order, $allHomepageItems, $newItemId;
    public $isAdding = false;

    public function render()
    {
        $homepageGrid = Option::byOptionName('artsthread_homepage_grid')->first();
        $gridIds = json_decode(stripslashes($homepageGrid->option_value), true);

        $this->homepageGrid = isset($this->order) ? $this->getItemsByIdArray($this->order) : $this->getItemsByIdArray($gridIds);
        $this->allHomepageItems = Homepage::all();

        return view('livewire.homepage.grid', [
            'homepageGrid' => $this->homepageGrid,
            'allHomepageItems' => $this->allHomepageItems
        ]);
    }

    public function updateOrder($updatedOrder)
    {
        $this->homepageGrid = $this->getItemsByIdArray($updatedOrder);
        $this->order = $updatedOrder;
    }

    public function saveOrder($order)
    {
        $newOrder = [];
        foreach ($order as $item){
            $newOrder[] = $item['id'];
        }
        $homepageGrid = Option::byOptionName('artsthread_homepage_grid')->first();
        $homepageGrid->option_value = json_encode($newOrder);
        $homepageGrid->save();

        $this->homepageGrid = $this->getItemsByIdArray($newOrder);

        $this->notification()->notify([
            'title'       => 'Order saved!',
            'icon'        => 'success'
        ]);
    }

    public function remove($itemId)
    {
        $this->dialog()->confirm([
            'title'       => 'Are you sure you want to remove?',
            'icon'        => 'warning',
            'accept'      => [
                'label'  => 'Yes, delete it',
                'method' => 'confirmRemove',
                'params' => $itemId,
            ],
            'reject' => [
                'label'  => 'No, cancel',
            ],
        ]);
    }

    public function confirmRemove($id)
    {
        $homepageGrid = Option::byOptionName('artsthread_homepage_grid')->first();
        $gridIds = json_decode(stripslashes($homepageGrid->option_value), true);

        if (($key = array_search($id, $gridIds)) !== false) {
            unset($gridIds[$key]);
        }

        $homepageGrid->option_value = json_encode($gridIds);
        $homepageGrid->save();
        $this->homepageGrid = $this->getItemsByIdArray($gridIds);

        $this->notification()->notify([
            'title'       => 'Item deleted!',
            'icon'        => 'success'
        ]);
    }

    public function showAdd()
    {
        $this->isAdding = true;
    }

    public function add()
    {
        if ($this->newItemId){
            $homepageGrid = Option::byOptionName('artsthread_homepage_grid')->first();
            $gridIds = json_decode(stripslashes($homepageGrid->option_value));
            $gridIds[] = $this->newItemId;

            $homepageGrid->option_value = json_encode($gridIds);
            $homepageGrid->save();

            $this->isAdding = false;

            $this->notification()->notify([
                'title'       => 'Item added!',
                'icon'        => 'success'
            ]);
        }
    }

    private function getItemsByIdArray(array $items)
    {
        $homepageGrid = [];
        $this->order = $items;
        foreach ($items as $id){
            $itemId = $id;
            if (is_array($id)){
                $itemId = $id['value'];
            }

            $item = Homepage::find($itemId);
            if ($item)
                $homepageGrid[] = $item;
        }

        return $homepageGrid;
    }
}
