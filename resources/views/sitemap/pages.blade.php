<?php echo '<?xml version="1.0" encoding="UTF-8"?>'; ?>
<urlset
xmlns="http://www.sitemaps.org/schemas/sitemap/0.9"
xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance"
xsi:schemaLocation="http://www.sitemaps.org/schemas/sitemap/0.9
http://www.sitemaps.org/schemas/sitemap/0.9/sitemap.xsd">
<url>
    <loc>{{url('/')}}</loc>
    <lastmod>{{ \Carbon\Carbon::now()->tz('UTC')->toAtomString()  }}</lastmod>
    <priority>1.00</priority>
</url>
<url>
    <loc>{{url('contact')}}</loc>
    <lastmod>{{ \Carbon\Carbon::now()->tz('UTC')->toAtomString() }}</lastmod>
    <priority>0.80</priority>
</url>
<url>
    <loc>{{url('about')}}</loc>
    <lastmod>{{ \Carbon\Carbon::now()->tz('UTC')->toAtomString()  }}</lastmod>
    <priority>0.80</priority>
</url>
<url>
    <loc>{{url('privacy-policy')}}</loc>
    <lastmod>{{ \Carbon\Carbon::now()->tz('UTC')->toAtomString()  }}</lastmod>
    <priority>0.80</priority>
</url>
<url>
    <loc>{{url('terms-and-condition')}}</loc>
    <lastmod>{{ \Carbon\Carbon::now()->tz('UTC')->toAtomString()  }}</lastmod>
    <priority>0.80</priority>
</url>

</urlset>