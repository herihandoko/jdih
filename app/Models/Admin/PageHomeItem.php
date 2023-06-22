<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;

use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Models\Activity;

class PageHomeItem extends Model
{
    use LogsActivity;
    
    protected static $logAttributes = [
        'seo_title',
        'seo_meta_description',
        'header_type',
        'header_type_image_heading',
        'header_type_image_content',
        'header_type_image_btn_text',
        'header_type_image_btn_url',
        'header_type_image_photo',
        'header_type_video_heading',
        'header_type_video_content',
        'header_type_video_btn_text',
        'header_type_video_btn_url',
        'header_type_video_yt_url',
        'why_choose_title',
        'why_choose_subtitle',
        'why_choose_status',
        'special_title',
        'special_subtitle',
        'special_content',
        'special_btn_text',
        'special_btn_url',
        'special_yt_video',
        'special_bg',
        'special_video_bg',
        'special_status',
        'service_title',
        'service_subtitle',
        'service_status',
        'testimonial_title',
        'testimonial_subtitle',
        'testimonial_status',
        'testimonial_bg',
        'project_title',
        'project_subtitle',
        'project_status',
        'team_member_title',
        'team_member_subtitle',
        'team_member_status',
        'appointment_title',
        'appointment_text',
        'appointment_btn_text',
        'appointment_btn_url',
        'appointment_bg',
        'appointment_status',
        'latest_blog_title',
        'latest_blog_subtitle',
        'latest_blog_status',
        'newsletter_title',
        'newsletter_text',
        'newsletter_bg',
        'newsletter_status',
        'artikel_title',
        'artikel_subtitle',
        'artikel_bg',
        'artikel_status',
        'majalah_title',
        'majalah_subtitle',
        'majalah_bg',
        'majalah_status'];

    protected static $recordEvents = ['created', 'updated', 'deleted'];
    protected static $logOnlyDirty = true;
    protected static $logName = 'Beranda';

    public function getDescriptionForEvent(string $eventName): string
    {
        return "Have {$eventName} Beranda Data";
    }
    
    public function tapActivity(Activity $activity)
    {
        $activity->causer_id = session('id');
    }
    
    protected $fillable = [
        'seo_title',
        'seo_meta_description',
        'header_type',
        'header_type_image_heading',
        'header_type_image_content',
        'header_type_image_btn_text',
        'header_type_image_btn_url',
        'header_type_image_photo',
        'header_type_video_heading',
        'header_type_video_content',
        'header_type_video_btn_text',
        'header_type_video_btn_url',
        'header_type_video_yt_url',
        'why_choose_title',
        'why_choose_subtitle',
        'why_choose_status',
        'special_title',
        'special_subtitle',
        'special_content',
        'special_btn_text',
        'special_btn_url',
        'special_yt_video',
        'special_bg',
        'special_video_bg',
        'special_status',
        'service_title',
        'service_subtitle',
        'service_status',
        'testimonial_title',
        'testimonial_subtitle',
        'testimonial_status',
        'testimonial_bg',
        'project_title',
        'project_subtitle',
        'project_status',
        'team_member_title',
        'team_member_subtitle',
        'team_member_status',
        'appointment_title',
        'appointment_text',
        'appointment_btn_text',
        'appointment_btn_url',
        'appointment_bg',
        'appointment_status',
        'latest_blog_title',
        'latest_blog_subtitle',
        'latest_blog_status',
        'newsletter_title',
        'newsletter_text',
        'newsletter_bg',
        'newsletter_status',

        'artikel_title',
        'artikel_subtitle',
        'artikel_bg',
        'artikel_status',
        'majalah_title',
        'majalah_subtitle',
        'majalah_bg',
        'majalah_status'
    ];

}
