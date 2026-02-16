<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // Projects
        Schema::table('projects', function (Blueprint $table) {
            $table->string('title_en')->nullable()->after('title');
            $table->string('title_es')->nullable()->after('title_en');
            $table->text('short_description_en')->nullable()->after('short_description');
            $table->text('short_description_es')->nullable()->after('short_description_en');
            $table->text('description_en')->nullable()->after('description');
            $table->text('description_es')->nullable()->after('description_en');
        });

        // Copy existing data to _en columns
        DB::table('projects')->get()->each(function ($row) {
            DB::table('projects')->where('id', $row->id)->update([
                'title_en' => $row->title,
                'short_description_en' => $row->short_description,
                'description_en' => $row->description,
            ]);
        });

        // Testimonials
        Schema::table('testimonials', function (Blueprint $table) {
            $table->text('quote_en')->nullable()->after('quote');
            $table->text('quote_es')->nullable()->after('quote_en');
            $table->string('author_title_en')->nullable()->after('author_title');
            $table->string('author_title_es')->nullable()->after('author_title_en');
        });

        DB::table('testimonials')->get()->each(function ($row) {
            DB::table('testimonials')->where('id', $row->id)->update([
                'quote_en' => $row->quote,
                'author_title_en' => $row->author_title,
            ]);
        });

        // Blog posts
        Schema::table('blog_posts', function (Blueprint $table) {
            $table->string('title_en')->nullable()->after('title');
            $table->string('title_es')->nullable()->after('title_en');
            $table->text('excerpt_en')->nullable()->after('excerpt');
            $table->text('excerpt_es')->nullable()->after('excerpt_en');
            $table->longText('body_en')->nullable()->after('body');
            $table->longText('body_es')->nullable()->after('body_en');
        });

        DB::table('blog_posts')->get()->each(function ($row) {
            DB::table('blog_posts')->where('id', $row->id)->update([
                'title_en' => $row->title,
                'excerpt_en' => $row->excerpt,
                'body_en' => $row->body,
            ]);
        });

        // Blog categories
        Schema::table('blog_categories', function (Blueprint $table) {
            $table->string('name_en')->nullable()->after('name');
            $table->string('name_es')->nullable()->after('name_en');
        });

        DB::table('blog_categories')->get()->each(function ($row) {
            DB::table('blog_categories')->where('id', $row->id)->update([
                'name_en' => $row->name,
            ]);
        });
    }

    public function down(): void
    {
        Schema::table('projects', function (Blueprint $table) {
            $table->dropColumn(['title_en', 'title_es', 'short_description_en', 'short_description_es', 'description_en', 'description_es']);
        });
        Schema::table('testimonials', function (Blueprint $table) {
            $table->dropColumn(['quote_en', 'quote_es', 'author_title_en', 'author_title_es']);
        });
        Schema::table('blog_posts', function (Blueprint $table) {
            $table->dropColumn(['title_en', 'title_es', 'excerpt_en', 'excerpt_es', 'body_en', 'body_es']);
        });
        Schema::table('blog_categories', function (Blueprint $table) {
            $table->dropColumn(['name_en', 'name_es']);
        });
    }
};
