<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class FixPostMediaUrls extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'posts:fix-media-urls';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Fix existing post media URLs to use public storage URLs';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('Fixing post media URLs...');
        
        $posts = \App\Models\Post::whereNotNull('media')->whereRaw("json_array_length(media) > 0")->get();
        
        $fixedCount = 0;
        
        foreach ($posts as $post) {
            $media = $post->media;
            $newMedia = [];
            $updated = false;
            
            foreach ($media as $mediaPath) {
                // Check if it's already a full URL
                if (filter_var($mediaPath, FILTER_VALIDATE_URL)) {
                    $newMedia[] = $mediaPath;
                    continue;
                }
                
                // Convert storage path to public URL
                if (\Illuminate\Support\Facades\Storage::disk('public')->exists($mediaPath)) {
                    $newMedia[] = \Illuminate\Support\Facades\Storage::disk('public')->url($mediaPath);
                    $updated = true;
                } else {
                    // Keep original if file doesn't exist
                    $newMedia[] = $mediaPath;
                }
            }
            
            if ($updated) {
                $post->update(['media' => $newMedia]);
                $fixedCount++;
            }
        }
        
        $this->info("✅ Fixed media URLs in {$fixedCount} posts!");
        $this->info('📱 Posts now use public storage URLs');
        $this->info('🖼️ Images should now load properly in the frontend');
    }
}
