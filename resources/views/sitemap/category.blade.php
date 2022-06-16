<?php echo '<?xml version="1.0" encoding="UTF-8"?>'; ?>
<urlset
xmlns="http://www.sitemaps.org/schemas/sitemap/0.9"
xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance"
xsi:schemaLocation="http://www.sitemaps.org/schemas/sitemap/0.9
http://www.sitemaps.org/schemas/sitemap/0.9/sitemap.xsd">

     @php
     $alphas = range('A', 'Z');
    @endphp
    @foreach($alphas as $alpha)

    <url>
             <loc>{{route("baby-names.letter",[$category,"boy", $alpha])}}</loc>
            <lastmod>{{ (@$alpha->updated_at) ? @$alpha->updated_at->tz('UTC')->toAtomString():
             \Carbon\Carbon::now()->tz('UTC')->toAtomString() }}</lastmod>
            <priority>0.9</priority>
        </url>

    @endforeach

           @foreach($alphas as $alpha)

           <url>
             <loc>{{route("baby-names.letter",[$category,"girl",$alpha] ) }}</loc>
            
            <lastmod>{{ (@$alpha->updated_at) ? @$alpha->updated_at->tz('UTC')->toAtomString():
             \Carbon\Carbon::now()->tz('UTC')->toAtomString() }}</lastmod>
            <priority>0.9</priority>
        </url>
                 
            @endforeach
       

</urlset>