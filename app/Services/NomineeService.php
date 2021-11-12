<?php

namespace VotingSystem\Services;

use Illuminate\Support\Facades\Storage;
use VotingSystem\Models\Nominee;
use Illuminate\Http\Request;
use VotingSystem\Exceptions\ServiceException;
use VotingSystem\Models\NomineeImage;
use VotingSystem\Services\Service;

class NomineeService extends Service
{
    public function create(Request $request)
    {
        $nominee = $this->processData($request, new Nominee());
        $nominee->save();
        return $nominee;
    }

    public function update(Request $request)
    {
        $nominee = Nominee::find($request->id);
        if (empty($nominee)) {
            throw new ServiceException("Nominee doesn't exist !");
        }
        $nominee = $this->processData($request, $nominee);
        $nominee->save();
        return $nominee;
    }

    public function statusUpdate($id)
    {
        $nominee = Nominee::find($id);
        if (empty($nominee)) {
            throw new ServiceException("Nominee doesn't exist !");
        }
        $nominee->toggleStatus()->save();
        return !$nominee->status ? 'Nominee Deactivated Successfully' : 'Nominee Activated Successfully';
    }

    public function delete(Request $request)
    {
        $nominee = Nominee::find($request->id);
        if (empty($nominee)) {
            throw new ServiceException("Nominee doesn't exist !");
        }
        return $nominee->delete();
    }

    private function processData(Request $request, Nominee $nominee)
    {
        $nominee->name = $request->name;
        $nominee->designation = $request->designation;
        $nominee->manifesto = $request->manifesto;
        return $nominee;
    }

    public function addCategories(Request $request)
    {
        $nominee = Nominee::find($request->id);
        if (empty($nominee)) {
            throw new ServiceException('Invalid Nominee');
        }
        $nominee->categories()->sync($request->categories);
        return ['message' => 'Successfully Added'];
    }

    public function addImage(Request $request)
    {
        $nominee = Nominee::with('avatar')->find($request->nominee_id);
        $file = $request->file('image');
        $name = "$request->nominee_id." . $file->clientExtension();
        $filePath = "avatars/$name";
        if (!empty($nominee->avatar)) {
            $image = $nominee->avatar;
        } else {
            $image = new NomineeImage();
            $image->nominee_id = $request->nominee_id;
        }
        if (Storage::disk('public')->exists($filePath)) {
            Storage::disk('public')->delete($filePath);
        }
        Storage::disk('public')->put($filePath, file_get_contents($file), 'public');
        $image->url = Storage::disk('public')->url($filePath);
        $image->save();
        return ['message' => 'Saved successfully!'];
    }
}
