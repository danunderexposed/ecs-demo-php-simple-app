<?php

namespace App\Http\Livewire;

use App\Models\Option;
use App\Models\Sector;
use App\Models\Project;
use Livewire\Component;
use WireUi\Traits\Actions;

class FeaturedProjects extends Component
{
    use Actions;

    public $options, $order, $projects, $projectSearch, $projectSearchResults;
    public $isAdding, $orderUpdated = false;
    protected $optionId = 'artsthread_featured_projects';

    protected $queryString = [
        'projectSearch' => ['except' => ''],
    ];

    public function render()
    {
        $option = Option::byOptionName($this->optionId)->first();
        if ($option) {
            if (is_array($this->order)){
                $this->projects = $this->getItemsByIdArray($this->order);
            } else {
                $this->projects = $this->getItemsByIdArray($option->getJsonValue());
            }
        }

        if (strlen($this->projectSearch) > 1){
            $this->projectSearchResults = Project::search($this->projectSearch, ['title'])->get();
        } else {
            $this->projectSearchResults = [];
        }

        return view('livewire.featured-projects', [
            'projects' => $this->projects
        ]);

    }

    public function updateOrder($order)
    {
        $this->projects = $this->getItemsByIdArray($order);
        $this->order = $order;
    }

    public function saveOrder()
    {
        $featuredProjects = Option::byOptionName($this->optionId)->first();
        $newOrder = [];
        foreach ($this->order as $item){
            $newOrder[] = $item['value'];
        }
        $featuredProjects->option_value = json_encode($newOrder);
        $featuredProjects->save();
        $this->order = null;

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
        $option = Option::byOptionName($this->optionId)->first();
        $gridIds = $option->getJsonValue();
        if (($key = array_search($id, $gridIds)) !== false) {
            unset($gridIds[$key]);
        }
        $option->option_value = json_encode($gridIds);
        $option->save();
        $this->projects = $this->getItemsByIdArray($gridIds);

        $this->notification()->notify([
            'title'       => 'Item deleted!',
            'icon'        => 'success'
        ]);
    }

    public function showAdd()
    {
        $this->isAdding = true;
    }

    public function add($itemId)
    {
        $selectedOption = Option::byOptionName($this->optionId)->first();

        $optionIds = json_decode(stripslashes($selectedOption->option_value));
        $optionIds[] = $itemId;

        $selectedOption->option_value = json_encode($optionIds);
        $selectedOption->save();
        $this->projects = $this->getItemsByIdArray($optionIds);
        $this->isAdding = false;

        $this->notification()->notify([
            'title'       => 'Item added!',
            'icon'        => 'success'
        ]);

    }

    private function getItemsByIdArray(array $items)
    {
        $rtn = [];
        foreach ($items as $id){
            $itemId = $id;
            if (is_array($id)){
                $itemId = $id['value'];
            }
            $item = Project::find($itemId);
            if ($item)
                $rtn[] = $item;
        }

        return $rtn;
    }
}
