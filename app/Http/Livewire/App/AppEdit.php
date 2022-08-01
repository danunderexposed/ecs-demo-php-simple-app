<?php

namespace App\Http\Livewire\App;

use App\Models\App;
use App\Models\Sector;
use Livewire\Component;
use App\Models\Specialism;
use WireUi\Traits\Actions;

class AppEdit extends Component
{
    use Actions;

    public $app, $appImage, $appId, $filterSectors, $filterOverride, $addContentModule;
    protected $listeners = ['removeContentModule', 'updateContentModule'];
    protected $rules = [
        'app.title' => 'required',
        'app.app_id' => 'required',
        'app.app_type' => 'required',
        'app.school_id' => '',
        'app.event_id' => '',
        'app.competition_id' => '',
        'app.courses_exclude' => '',
        'app.hide_projects' => '',
        'app.show_course_index' => '',
        'app.graduation_year' => 'required',
        'app.enable_year_filter' => '',
        'app.projects_per_page' => 'required',
        'app.override_filters' => '',
        'app.filter_sectors' => '',
        'app.content_modules' => '',
        'app.index_title' => '',
        'app.index_text' => '',
        'app.listings_title' => '',
        'app.listings_text' => '',
        'app.capitalise_buttons' => '',
        'app.padding_left' => 'required',
        'app.padding_right' => 'required',
        'app.padding_top' => 'required',
        'app.padding_bottom' => 'required',
        'app.google_analytics' => '',
        'app.google_analytics_global' => '',
    ];
    public $contentModules = [];
    public $contentModulesList = [
        ['name' => 'Full width text', 'slug' => 'full_width_text'],
        ['name' => '2 column text', 'slug' => '2_col_text'],
        ['name' => 'Full width image', 'slug' => 'full_width_image'],
        ['name' => 'Full width video carousel', 'slug' => 'full_width_video_carousel'],
        ['name' => 'Portrait video carousel', 'slug' => 'portrait_video_carousel'],
        ['name' => 'Landscape video carousel', 'slug' => 'landscape_video_carousel'],
    ];

    public function mount($id)
    {
        if($id == 'new'){
            $this->app = new App();
            // set defaults
            $this->app->padding_top = $this->app->padding_bottom = $this->app->padding_left = $this->app->padding_right = 0;
            $this->app->hide_projects = $this->app->show_course_index = $this->app->enable_year_filter = $this->app->override_filters = $this->app->capitalise_buttons = $this->app->google_analytics_global = false;
        } else {
            $this->app = App::find($id);
        }

        //if ($this->app->filter_sectors){
            $this->filterSectors = $this->app->filter_sectors ?? [];
        //}
        $this->contentModules = $this->app->content_modules ?? [];
        $this->filterOverride = $this->app->filters_override ?? [];

        $this->appId = $id;
    }

    public function render()
    {
        $sectors = Sector::all();
        $specialisms = Specialism::all();

        return view('livewire.app.app-edit',
            [
                'app' => $this->app,
                'all_sectors' => $sectors,
                'all_specialisms' => $specialisms,
            ]
        );
    }

    public function store()
    {
        $validatedData = $this->validate($this->rules);

        $id = $this->appId == 'new' ? false : $this->appId;
        $data = $validatedData['app'];

        $data['filter_sectors'] = $this->filterSectors ?? [];
        $data['filters_override'] = $this->filterOverride ?? [];
        $data['content_modules'] = $this->contentModules ?? [];

        //dd($data);
        $app = App::updateOrCreate(['id' => $id], $data);
        if ($app){
            if (!$id){
                $this->appId = $app->id;
            }

            $this->notification()->notify([
                'title'       => 'App saved!',
                'icon'        => 'success'
            ]);
        } else {
            $this->notification()->notify([
                'title'       => 'There was an error!',
                'icon'        => 'error'
            ]);
        }
    }

    public function addFilterSector()
    {
        if ($this->filterSectors){
            $this->filterSectors[] = "";
        } else {
            $this->filterSectors = [""];
        }
    }

    public function addOverrideFilterSector()
    {
        $placeholder = [
            'sector_title' => '',
            'sector_id' => '',
            'specialisms' => [
                [
                    'specialism_id' => '',
                    'specialism_name' => '',
                ]
            ],
        ];
        if ($this->filterOverride){
            $this->filterOverride[] = $placeholder;
        } else {
            $this->filterOverride = [$placeholder];
        }
    }

    public function addOverrideFilterSpecialism($index)
    {
        $this->filterOverride[$index]['specialisms'][] = [
            'specialism_id' => '',
            'specialism_name' => '',
        ];
    }

    public function addContentModule()
    {
        if ($this->addContentModule){
            $this->contentModules[] = [
                'key' => uniqid(),
                'type' => $this->addContentModule,
            ];
        }
        //dd($this->contentModules);
    }

    public function updateContentModule($data)
    {
        //dd($data);
        foreach ($this->contentModules as $i => $m){
            if ($m['key'] == $data['index'])
                $this->contentModules[$i]['values'] = $data['values'];
        }
    }

    public function removeContentModule($index)
    {
        foreach ($this->contentModules as $i => $m){
            if ($m['key'] == $index)
                unset($this->contentModules[$i]);
        }
    }

    public function updateContentModulesOrder($order)
    {
        $contentModules = $this->contentModules;
        $newOrder = [];
        foreach ($order as $o){
            foreach ($contentModules as $m){
                if ($m['key'] == $o['value']){
                    $newOrder[] = $m;
                    break;
                }
            }
        }

        $this->contentModules = $newOrder;


    }

    public function removeFilterSector($index)
    {
        unset($this->filterSectors[$index]);
    }

    public function removeOverrideFilterSector($index)
    {
        unset($this->filterOverride[$index]);
    }

    public function removeOverrideFilterSpecialism($index, $sIndex)
    {
        unset($this->filterOverride[$index]['specialisms'][$sIndex]);
    }
}

