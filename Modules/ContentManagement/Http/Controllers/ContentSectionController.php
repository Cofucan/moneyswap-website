<?php

namespace Modules\ContentManagement\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\ContentManagement\Entities\ContentSection;
use Illuminate\Support\Str;
use Image;
use File;

class ContentSectionController extends Controller
{
    private function typeOptions()
    {
        return [
            'text' => 'Text',
            'hero' => 'Hero',
            'cta' => 'CTA',
            'split' => 'Split',
            'grid' => 'Grid',
            'stats' => 'Stats',
            'faq' => 'FAQ',
            'custom' => 'Custom',
        ];
    }

    private function normalizeData($data)
    {
        if ($data === null || $data === '') {
            return null;
        }

        if (is_array($data)) {
            return $data;
        }

        $decoded = json_decode($data, true);
        if (json_last_error() !== JSON_ERROR_NONE) {
            return false;
        }

        return $decoded;
    }

    public function manage($page = 'home')
    {
        $sections = ContentSection::where('page', $page)->orderBy('display_order')->get();
        $types = $this->typeOptions();
        return view('contentmanagement::sections.manage', compact('sections', 'page', 'types'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'page' => 'required|string|max:50',
            'section_key' => 'required|string|max:80',
            'type' => 'nullable|string|max:40',
            'headline' => 'nullable|string',
            'subtext' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,jpg,png,gif|max:1000',
            'data' => 'nullable',
            'display_order' => 'nullable|integer|min:1',
            'published' => 'nullable|boolean',
        ]);

        $data = $this->normalizeData($request->input('data'));
        if ($data === false) {
            return redirect()->back()->withInput()->with('error', 'Section data must be valid JSON.');
        }

        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $this->storeImage($request->file('image'), $request->section_key);
        }

        ContentSection::create([
            'page' => $request->page,
            'section_key' => $request->section_key,
            'type' => $request->type ?? 'text',
            'headline' => $request->headline,
            'subtext' => $request->subtext,
            'image' => $imagePath,
            'data' => $data,
            'display_order' => $request->display_order ?? 1,
            'published' => $request->has('published') ? (bool) $request->published : true,
        ]);

        return redirect()->route('content-sections.manage', $request->page)->with('success', 'Section created successfully.');
    }

    public function update(Request $request, ContentSection $section)
    {
        $this->validate($request, [
            'page' => 'required|string|max:50',
            'section_key' => 'required|string|max:80|unique:content_sections,section_key,' . $section->id . ',id,page,' . $request->page,
            'type' => 'nullable|string|max:40',
            'headline' => 'nullable|string',
            'subtext' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,jpg,png,gif|max:1000',
            'data' => 'nullable',
            'display_order' => 'nullable|integer|min:1',
            'published' => 'nullable|boolean',
        ]);

        $data = $this->normalizeData($request->input('data'));
        if ($data === false) {
            return redirect()->back()->withInput()->with('error', 'Section data must be valid JSON.');
        }

        $imagePath = $section->image;
        if ($request->hasFile('image')) {
            $imagePath = $this->storeImage($request->file('image'), $request->section_key);
        }

        $section->update([
            'page' => $request->page,
            'section_key' => $request->section_key,
            'type' => $request->type ?? $section->type ?? 'text',
            'headline' => $request->headline,
            'subtext' => $request->subtext,
            'image' => $imagePath,
            'data' => $data,
            'display_order' => $request->display_order ?? 1,
            'published' => $request->has('published') ? (bool) $request->published : $section->published,
        ]);

        return redirect()->route('content-sections.manage', $request->page)->with('success', 'Section updated successfully.');
    }

    public function toggle(ContentSection $section)
    {
        $section->published = ! $section->published;
        $section->save();

        return redirect()->route('content-sections.manage', $section->page)->with('success', 'Section status updated.');
    }

    public function destroy(ContentSection $section)
    {
        $page = $section->page;
        $section->delete();
        return redirect()->route('content-sections.manage', $page)->with('success', 'Section deleted successfully.');
    }

    public function changeImage(Request $request, ContentSection $section)
    {
        $this->validate($request, [
            'image' => 'required|image|mimes:jpeg,jpg,png,gif|max:1000',
        ]);

        if ($request->hasFile('image')) {
            $section->image = $this->storeImage($request->file('image'), $section->section_key);
            $section->save();
        }

        return redirect()->route('content-sections.manage', $section->page)->with('success', 'Section image updated.');
    }

    private function storeImage($file, $key)
    {
        if (!File::exists('images/content-sections')) {
            File::makeDirectory('images/content-sections', 0777, true);
        }
        $filename = Str::slug($key) . '_' . time() . '.' . $file->getClientOriginalExtension();
        $path = 'images/content-sections/' . $filename;
        Image::make($file)->save($path);
        return $path;
    }
}
