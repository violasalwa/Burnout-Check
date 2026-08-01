<?php

namespace Tests\Feature;

use App\Http\Controllers\AdminSoalController;
use App\Models\Soal;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ViewErrorBag;
use Tests\TestCase;

class AdminSoalKategoriDropdownTest extends TestCase
{
    public function test_edit_form_uses_dropdown_for_allowed_categories(): void
    {
        $soal = Soal::create([
            'pertanyaan' => 'Contoh pertanyaan',
            'kategori' => 'Exhaustion',
            'is_active' => true,
        ]);

        View::share('errors', new ViewErrorBag());

        $controller = new AdminSoalController();
        $view = View::make('admin.soal.edit', ['soal' => $soal]);
        $html = $view->render();

        $this->assertStringContainsString('<select id="kategori"', $html);
        $this->assertStringContainsString('>Exhaustion<', $html);
        $this->assertStringContainsString('>Mental Distance<', $html);
        $this->assertStringContainsString('>Cognitive Impairment<', $html);
        $this->assertStringContainsString('>Emotional Impairment<', $html);
        $this->assertStringContainsString('>Psychological Distress<', $html);
        $this->assertStringContainsString('>Psychosomatic Complaints<', $html);
    }
}
