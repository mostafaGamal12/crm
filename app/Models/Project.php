<?php

namespace App\Models;

use App\Filters\Filters;
use App\Traits\CompanyTrait;
use App\Traits\hasImages;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    const IMAGE_TYPE_IMAGE        = 'IMAGE';
    const IMAGE_TYPE_LOGO         = 'LOGO';
    const IMAGE_TYPE_BROCHURE     = 'BROCHURE';
    const IMAGE_TYPE_MASTER_PLANE = 'MASTER_PLANE';
    const IMAGE_TYPE_INSTALLMENT  = 'INSTALLMENT';
    const IMAGE_TYPE_PDF          = 'PDF';


    use hasImages, CompanyTrait;

    protected $guarded = [];
    //    protected $with    = ['phases','features','types','district'];
    protected $appends = ['logo', 'brochure', 'master_plane_image', 'installment_image', 'pdf', 'images'];

    //    public function company()
    //    {
    //        return $this->belongsTo(Country::class)->withDefault();
    //    }

    public function features()
    {
        return $this->belongsToMany(ProjectFeature::class, 'project_project_feature', 'project_id', 'feature_id');
    }

    public function types()
    {
        return $this->belongsToMany(ProjectType::class, 'project_project_type', 'project_id', 'type_id');
    }

    public function phases()
    {
        return $this->HasMany(Phase::class);
    }

    public function country()
    {
        return $this->belongsTo(Country::class)->withDefault();
    }

    public function governorate()
    {
        return $this->belongsTo(Governorate::class)->withDefault();
    }

    public function city()
    {
        return $this->belongsTo(City::class)->withDefault();
    }

    public function district()
    {
        return $this->belongsTo(District::class)->withDefault();
    }

    public function getLogoAttribute()
    {
        return $this->getImage(self::IMAGE_TYPE_LOGO);
    }

    public function getBrochureAttribute()
    {
        return $this->getImage(self::IMAGE_TYPE_BROCHURE);
    }

    public function getMasterPlaneImageAttribute()
    {
        return $this->getImage(self::IMAGE_TYPE_MASTER_PLANE);
    }

    public function getInstallmentImageAttribute()
    {
        return $this->getImage(self::IMAGE_TYPE_INSTALLMENT);
    }

    public function getPdfAttribute()
    {
        return $this->getImage(self::IMAGE_TYPE_PDF);
    }

    public function getImagesAttribute()
    {
        return $this->getImages(self::IMAGE_TYPE_IMAGE);
    }

    public function scopeFilter($query, Filters $filter)
    {
        return $filter->apply($query);
    }

    public function brokers()
    {
        return $this->belongsToMany(Broker::class, 'broker_projects')->withPivot('commission');
    }
}