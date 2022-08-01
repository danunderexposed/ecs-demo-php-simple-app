<?php

use Illuminate\Support\Facades\Route;

// Admin routes
Route::prefix('admin')->group(function () {
    Route::middleware(['auth:sanctum', 'verified', 'can:access_admin'])->group(function(){
        Route::get('/dashboard', function () {
            return view('dashboard');
        })->name('dashboard');

        Route::get('/countries', App\Http\Livewire\Countries::class)->name('countries');
        Route::get('/cities', App\Http\Livewire\Cities::class)->name('cities');
        Route::get('/schools', App\Http\Livewire\Schools\Schools::class)->name('schools.index');
        Route::get('/schools/{id}', App\Http\Livewire\Schools\SchoolsEdit::class)->name('schools.edit');

        Route::get('/sectors', App\Http\Livewire\Sectors::class)->name('sectors');
        Route::get('/courses', App\Http\Livewire\Courses\CoursesList::class)->name('courses.list');
        Route::get('/courses/{id}', App\Http\Livewire\Courses\CourseEdit::class)->name('courses.edit');
        Route::get('/study-levels', App\Http\Livewire\StudyLevels::class)->name('study-levels');
        Route::get('/specialisms', App\Http\Livewire\Specialisms::class)->name('specialisms');

        // homepage routes
        Route::get('/homepage-grid', App\Http\Livewire\Homepage\HomepageGrid::class)->name('homepage.grid');
        Route::get('/homepage-grid/modules', App\Http\Livewire\Homepage\HomepageModuleList::class)->name('homepage.module-list');
        Route::get('/homepage-grid/module/edit/{id}', App\Http\Livewire\Homepage\HomepageModule::class)->name('homepage.module');
        Route::get('/homepage/sponsors', App\Http\Livewire\Homepage\HomepageSponsorList::class)->name('homepage.sponsor-list');
        Route::get('/homepage/sponsor/edit/{id}', App\Http\Livewire\Homepage\HomepageSponsor::class)->name('homepage.sponsor');
        Route::get('/homepage/hero/edit/{id}', App\Http\Livewire\Homepage\HomepageHeroEdit::class)->name('homepage.hero');
        Route::get('/homepage/heroes', App\Http\Livewire\Homepage\HomepageHeroList::class)->name('homepage.hero-list');
        Route::get('/homepage/featured-projects', App\Http\Livewire\Homepage\FeaturedProjects::class)->name('homepage.featured-projects');

        Route::get('/featured-projects', App\Http\Livewire\FeaturedProjects::class)->name('featured-projects');

        Route::get('/featured-profiles', App\Http\Livewire\FeaturedProfiles::class)->name('featured-profiles');


        Route::get('/competition-list', App\Http\Livewire\Competitions\CompetitionList::class)->name('competition-list');
        Route::get('/competition-edit/{id}', App\Http\Livewire\Competitions\CompetitionEdit::class)->name('competition-edit');
        Route::get('/competition-categories', App\Http\Livewire\Competitions\CompetitionCategories::class)->name('competition-categories');

        Route::get('/events', App\Http\Livewire\Events\EventsList::class)->name('events-list');
        Route::get('/event/{id}', App\Http\Livewire\Events\EventEdit::class)->name('event-edit');
        Route::get('/events-approval', App\Http\Livewire\Events\EventApproval::class)->name('event-approval');

        Route::get('/adverts', App\Http\Livewire\Adverts\AdvertsList::class)->name('adverts-list');
        Route::get('/advert/{id}', App\Http\Livewire\Adverts\AdvertEdit::class)->name('advert-edit');

        Route::get('/messages', App\Http\Livewire\Messages\MessageList::class)->name('message-list');
        Route::get('/message/{id}', App\Http\Livewire\Messages\MessageEdit::class)->name('message-edit');

        Route::get('/pages', App\Http\Livewire\Pages\PagesList::class)->name('pages-list');
        Route::get('/page/{id}', App\Http\Livewire\Pages\PageEdit::class)->name('page-edit');

        Route::get('/blog', App\Http\Livewire\Pages\PagesList::class)->name('blog-list');
        Route::get('/blog/{id}', App\Http\Livewire\Pages\PageEdit::class)->name('blog-edit');

        // portfolios
        Route::get('/projects/list', App\Http\Livewire\Projects\ProjectsList::class)->name('projects.list');
        Route::get('/projects/edit/{id}', App\Http\Livewire\Projects\ProjectEdit::class)->name('projects.edit');

        // apps
        Route::get('/apps/list', App\Http\Livewire\App\AppList::class)->name('apps.list');
        Route::get('/apps/edit/{id}', App\Http\Livewire\App\AppEdit::class)->name('apps.edit');

    });
});
