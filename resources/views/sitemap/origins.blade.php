<?php echo '<?xml version="1.0" encoding="UTF-8"?>'; ?>
<urlset
xmlns="http://www.sitemaps.org/schemas/sitemap/0.9"
xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance"
xsi:schemaLocation="http://www.sitemaps.org/schemas/sitemap/0.9
http://www.sitemaps.org/schemas/sitemap/0.9/sitemap.xsd">
    
    @if(@$origins)
        @foreach ($origins as $origin)
        <url>
             <loc>{{url('sitemap/origins/'.$origin->slug.'.xml')}}</loc>
            <lastmod>{{ ($origin->updated_at) ? $origin->updated_at->tz('UTC')->toAtomString():
             \Carbon\Carbon::now()->tz('UTC')->toAtomString() }}</lastmod>
            <priority>0.9</priority>
        </url>
        @endforeach
     @endif

</urlset>