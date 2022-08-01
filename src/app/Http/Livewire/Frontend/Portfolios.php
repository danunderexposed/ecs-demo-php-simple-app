<?php

namespace App\Http\Livewire\Frontend;

use App\Models\User;
use App\Models\Project;
use App\Models\Sector;
use App\Traits\UserAttributes;
use Livewire\Component;
use Livewire\WithPagination;
use WireUi\Traits\Actions;
use Illuminate\Support\Facades\DB;
use Log;

class Portfolios extends Component
{
    use Actions, WithPagination, UserAttributes;

    public $filterBy = 'projects';
    public $gradYears;
    public $gradYearsAll;
    public $name;
    public $location;
    public $school;
    public $specialisms;

    public function render()
    {
        return view('livewire.frontend.portfolios', [
            'entries' => $this->filterProjects(),
            "sectors" => Sector::with('specialisms')->get()
        ]);
    }

    public function updated($name, $value)
    {
        if($name == 'gradYearsAll') {
            if($value == 1) {
                $this->gradYears = [
                    2019 => 1,
                    2020 => 1,
                    2021 => 1,
                    2022 => 1,
                    2023 => 1,
                    2024 => 1,
                    2025 => 1
                ];
            } else {
                $this->gradYears = [
                    2019 => 0,
                    2020 => 0,
                    2021 => 0,
                    2022 => 0,
                    2023 => 0,
                    2024 => 0,
                    2025 => 0
                ];
            }
        }
        $this->resetPage();
        $this->render();
    }

    public function setType(string $type)
    {
        $this->filterBy = $type;
    }

    private function filterProjects()
    {
        if($this->filterBy == 'projects') {
            $query = DB::table('projects')
            ->select('users.*', 'countries.*', 'projects.*', 'cities.*')
            ->leftJoin('users', 'projects.user_id', '=', 'users.id')
            ->leftJoin('countries', 'users.country', '=', 'countries.id')
            ->leftJoin('cities', 'users.city', '=', 'cities.id');
        } else {
            $query = DB::table('users')
            ->select('users.*')
            ->leftJoin('countries', 'users.country', '=', 'countries.id')
            ->leftJoin('cities', 'users.city', '=', 'cities.id');
        }
        $query = $this->addSearchCriteria($query);
        
        return $query->where('userType', 'student')
                ->orderBy($this->filterBy == 'projects' ? 'projects.id' : 'users.projects_last_updated', 'desc')
                ->paginate(20);
    }

    /**
     *  Add search criteria (if any specified) to query returning projects/profiles
     * 
     * @return Eloquent $query
     */
    private function addSearchCriteria($query)
    {
        if($this->name && $this->name !== '') {
            $name = $this->name;
            $query = $query->where(function($query) use ($name) {
                $query->orWhere('firstname', 'LIKE', '%%' . $name . '%%')
                    ->orWhere('surname', 'LIKE', '%%' . $name . '%%');
            });
        }

        if($this->school && $this->school !== '') {
            $school = $this->school;
            $query = $query->whereIn('school', DB::table('schools')->select('id')->where('school', 'LIKE', '%%' . $school . '%%'));
        }

        if($this->location && $this->location !== '') {
            $location = $this->location;
            $query = $query->where(function($query) use ($location) {
                $query->orWhere('city', 'LIKE', '%%' . $location . '%%')
                    ->orWhere('country', 'LIKE', '%%' . $location . '%%');
            });
        }

        if($this->gradYears) {
            $activeYears = [];
            foreach ($this->gradYears as $year => $active) {
                if($active) {
                    array_push($activeYears, $year);
                }
            }

            if($activeYears) {
                $query = $query->whereIn('gradyear', $activeYears);
            }
        }

        if($this->specialisms) {
            $activeSpecialisms = [];
            foreach ($this->specialisms as $specialism => $active) {
                if($active) {
                    array_push($activeSpecialisms, $specialism);
                }
            }

            if($activeSpecialisms) {
                if($this->filterBy == 'projects') {
                    $query = $query->where(function($query) use ($activeSpecialisms) {
                        $query->orWhereIn('projects.specialism', $activeSpecialisms)
                            ->orWhereIn('projects.specialism2', $activeSpecialisms)
                            ->orWhereIn('projects.specialism3', $activeSpecialisms);
                    });
                } else {
                    $query = $query->where(function($query) use ($activeSpecialisms) {
                        $query->orWhereIn('users.specialism', $activeSpecialisms)
                            ->orWhereIn('users.specialism2', $activeSpecialisms)
                            ->orWhereIn('users.specialism3', $activeSpecialisms);
                    });
                }
            }
        }

        return $query;
    }
}
