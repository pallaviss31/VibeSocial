<?php

use Illuminate\Support\Facades\Route;
// auth components
use App\Livewire\Auth\Login;
use App\Livewire\Auth\Register;
use Illuminate\Support\Facades\Auth;
// admin components
use App\Livewire\Admin\AdminIndex;
use App\Livewire\Admin\QuizIndex;
// user components
use App\Livewire\Quiz\CreateQuiz;
use App\Livewire\Quiz\Questions;
use App\Livewire\User\Chat\Messenger;
use App\Livewire\User\courses\CourseIndex;
use App\Livewire\User\courses\Mycourses;
use App\Livewire\User\EventLibrary\EventCreate;
use App\Livewire\User\EventLibrary\Index;
use App\Livewire\User\EventLibrary\Show;
use App\Livewire\User\Quiz\QuizList;
use App\Livewire\User\Quiz\QuizResult;
use App\Livewire\User\Quiz\StartQuiz;
use App\Livewire\User\Quiz\ManageQuiz;
use App\Livewire\User\StudyGroups\Create;
use App\Livewire\User\StudyGroups\GroupShow;
use App\Livewire\User\StudyGroups\ListGroups;
use App\Livewire\User\Dashboard;
use App\Livewire\User\FindFriends;
use App\Livewire\User\Profile;

Route::middleware(['guest'])->group(function () {
    Route::get('/register', Register::class)->name('register');
    Route::get('/', Login::class)->name('login');
});

Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', Dashboard::class)->name('dashboard');

    Route::get('/admin/dashboard', AdminIndex::class)->name('admin.index');
    Route::get('/admin/quizzes/create', CreateQuiz::class)->name('admin.quiz.create');

    Route::get('/profile/{id?}', Profile::class)->name('profile');
    Route::get('/find', FindFriends::class)->name('find.friends');
    Route::get('/documents', App\Livewire\User\Library\Index::class)->name('documents');
    Route::get('/documents/upload', App\Livewire\User\Library\Upload::class)->name('documents.upload');
    Route::get('/assignments', App\Livewire\User\Assignment::class)->name('assignments');
    Route::get('/place', Index::class)->name('place');
    Route::get('/place/{id}', Show::class)->name('placeshow');
    Route::get('/place/create', EventCreate::class)->name('placecreate');
    Route::get('/groupcreate', Create::class)->name('groupcreate');
    Route::get('/groups/{group}', GroupShow::class)->name('groupshow');

    Route::get('/grouplist', ListGroups::class)->name('grouplist');
    Route::get('/mycourses', Mycourses::class)->name('mycourses');
    Route::get('/courses', CourseIndex::class)->name('courses');

    Route::get('/quiz/create', CreateQuiz::class)->name('quiz.create');

    Route::get('/quiz', QuizList::class)->name('quiz');
    Route::get('/quiz/{quiz}/questions', Questions::class)->name('quiz.manage');
    Route::get('/quiz/{quiz}/attempt', StartQuiz::class)->name('start.quiz');
    Route::get('/quiz/{quizId}/manage', ManageQuiz::class)->name('manage');

    Route::get('/quiz/{quizId}/result', QuizResult::class)
    ->name('quiz.result');


    Route::get('/admin/quizzes', QuizIndex::class)
        ->name('admin.quizzes');

    Route::get('/messages/{conversationId?}', Messenger::class)->name('messages');
    Route::post('/logout', function () {
        Auth::logout();
        return redirect()->route('login');
    })->name('logout');
});
