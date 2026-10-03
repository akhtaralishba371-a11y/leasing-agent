<?php

namespace App\Http\Controllers;

use App\Models\SiteContent;
use App\Support\Content;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class SiteContentController extends Controller
{
    /** Friendly names for each page group. */
    public const GROUPS = [
        'global' => 'Global (header & footer)',
        'home' => 'Home Page',
        'properties' => 'Properties Page',
        'about' => 'About Page',
        'agents' => 'Agents Page',
        'contact' => 'Contact Page',
        'become-agent' => 'Become a Leasing Agent',
    ];

    public function index(): View
    {
        $groups = SiteContent::query()
            ->selectRaw('`group`, COUNT(*) as fields')
            ->groupBy('group')
            ->pluck('fields', 'group');

        return view('site-content.index', [
            'groups' => $groups,
            'labels' => self::GROUPS,
        ]);
    }

    public function edit(string $group): View
    {
        $items = SiteContent::where('group', $group)->orderBy('sort')->orderBy('id')->get();

        abort_if($items->isEmpty(), 404);

        return view('site-content.edit', [
            'group' => $group,
            'title' => self::GROUPS[$group] ?? ucfirst($group),
            'items' => $items,
        ]);
    }

    public function update(Request $request, string $group): RedirectResponse
    {
        $items = SiteContent::where('group', $group)->get();
        $values = (array) $request->input('content', []);

        foreach ($items as $item) {
            if (array_key_exists($item->id, $values)) {
                $item->update(['value' => $values[$item->id]]);
            }
        }

        Content::flush();

        return redirect()->route('site-content.edit', $group)->with('status', 'Content updated.');
    }
}
