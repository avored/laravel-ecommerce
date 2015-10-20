<?php

/*
  Copyright (c) 2015, Purvesh
  All rights reserved.

  Redistribution and use in source and binary forms, with or without
  modification, are permitted provided that the following conditions are met:

 * Redistributions of source code must retain the above copyright notice, this
  list of conditions and the following disclaimer.

 * Redistributions in binary form must reproduce the above copyright notice,
  this list of conditions and the following disclaimer in the documentation
  and/or other materials provided with the distribution.

 * Neither the name of Mage2 nor the names of its
  contributors may be used to endorse or promote products derived from
  this software without specific prior written permission.

  THIS SOFTWARE IS PROVIDED BY THE COPYRIGHT HOLDERS AND CONTRIBUTORS "AS IS"
  AND ANY EXPRESS OR IMPLIED WARRANTIES, INCLUDING, BUT NOT LIMITED TO, THE
  IMPLIED WARRANTIES OF MERCHANTABILITY AND FITNESS FOR A PARTICULAR PURPOSE ARE
  DISCLAIMED. IN NO EVENT SHALL THE COPYRIGHT HOLDER OR CONTRIBUTORS BE LIABLE
  FOR ANY DIRECT, INDIRECT, INCIDENTAL, SPECIAL, EXEMPLARY, OR CONSEQUENTIAL
  DAMAGES (INCLUDING, BUT NOT LIMITED TO, PROCUREMENT OF SUBSTITUTE GOODS OR
  SERVICES; LOSS OF USE, DATA, OR PROFITS; OR BUSINESS INTERRUPTION) HOWEVER
  CAUSED AND ON ANY THEORY OF LIABILITY, WHETHER IN CONTRACT, STRICT LIABILITY,
  OR TORT (INCLUDING NEGLIGENCE OR OTHERWISE) ARISING IN ANY WAY OUT OF THE USE
  OF THIS SOFTWARE, EVEN IF ADVISED OF THE POSSIBILITY OF SUCH DAMAGE.
 */

namespace App\Http\Controllers;

use Mage2\Core\Model\ProductsTextValue;
use Mage2\Core\Model\ProductsVarcharValue;
use Mage2\Core\Model\CategoriesTextValue;
use Mage2\Core\Model\Attribute;
use Mage2\Core\Model\CategoriesVarcharValue;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;

abstract class Controller extends BaseController {

    use DispatchesJobs,
        ValidatesRequests;

    public function getAttributeValueModel($attribute) {
        if ($attribute->type == "textarea" && $attribute->entity_id == 1) {
            return new ProductsTextValue();
        }
        if (($attribute->type == "text" || $attribute->type == "select" || $attribute->type == "radio" || $attribute->type == "checkbox") && $attribute->entity_id == 1) {
            return new ProductsVarcharValue();
        }

        if ($attribute->type == "textarea" && $attribute->entity_id == 2) {
            return new CategoriesTextValue();
        }
        if (($attribute->type == "text" || $attribute->type == "select" || $attribute->type == "radio" || $attribute->type == "checkbox") && $attribute->entity_id == 2) {
            return new CategoriesVarcharValue();
        }

        return false;
    }

    /*
     * Save Attribute into EAV
     * 
     * 
     */

    public function saveAttribute($attributes, $entityId = null) {

        if (count($attributes) <= 0) {
            return true;
        }

        foreach ($attributes as $attributeId => $attributeValue) {
            if ($attributeValue == "") {
                continue;
            }

            $attribute = Attribute::findorfail($attributeId);

            $model = $this->getAttributeValueModel($attribute);
            //$tmpModel = clone($model);
            $attributeValue['entity_id'] = $entityId;
            $attributeValue['attribute_id'] = $attributeId;

            if ($model->where('entity_id', '=', $entityId)->where('attribute_id', '=', $attributeId)->get()->count() > 0) {
                //return $tmpModel;
                $model->update($attributeValue);
            } else {
                $model->create($attributeValue);
            }
        }
    }

    /*
     * @param \Symfony\Component\HttpFoundation\File\UploadedFile   $image
     *
     */

    public function uploadImage(UploadedFile $image, $for = 'products') {

        $random = implode('/', str_split(substr(str_shuffle(implode("", range('a', 'z'))), -3)));


        $path = base_path() . '/public/images/catalog/' . $for . "/" . $random . "/";
        $relativePath = '/images/catalog/' . $for . "/" . $random . "/";
        //Upload Images
        $imageName = $image->getClientOriginalName();
        $image->move($path, $imageName);

        return $relativePath . $imageName;
    }

}
