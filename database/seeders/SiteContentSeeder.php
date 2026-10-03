<?php

namespace Database\Seeders;

use App\Models\SiteContent;
use Illuminate\Database\Seeder;

class SiteContentSeeder extends Seeder
{
    public function run(): void
    {
        $items = [
            // ----- HOME PAGE -----
            ['home', 'Hero – Heading', 'home.hero.title', 'html', 'Find your perfect fit!<br>Rentals for UT Austin students'],
            ['home', 'Hero – Subtext', 'home.hero.lead', 'textarea', 'Work with knowledgeable agents who make leasing simple. Browse exclusive Tower Realty listings — always free for our clients.'],

            ['home', 'About – Eyebrow', 'home.about.eyebrow', 'text', 'About Us'],
            ['home', 'About – Statement', 'home.about.statement', 'textarea', 'At Tower Leasing, we specialize in connecting UT Austin students with the perfect place to call home.'],
            ['home', 'About – Paragraph', 'home.about.text', 'textarea', "We know that finding an apartment on or near campus can be overwhelming, but we're here to take that burden off your shoulders and turn the process into an exciting and easy experience. Our services are always free for students."],
            ['home', 'About – Stat 1 label', 'home.about.stat1_label', 'text', 'Helping students since'],
            ['home', 'About – Stat 2 label', 'home.about.stat2_label', 'text', 'Browse over'],
            ['home', 'About – Stat 3 label', 'home.about.stat3_label', 'text', 'Trusted by'],

            ['home', 'Services – Overlay fact', 'home.services.overlay_fact', 'textarea', 'Exclusive Tower Leasing listings — hundreds of near-campus options, always free for students.'],
            ['home', 'Services – Item 1 title', 'home.services.item1_title', 'text', '1. Get access to exclusive Tower Leasing listings'],
            ['home', 'Services – Item 1 description', 'home.services.item1_desc', 'textarea', "Hundreds of curated near-campus apartments available only through Tower Leasing — properties you won't find on any public rental site."],
            ['home', 'Services – Item 2 title', 'home.services.item2_title', 'text', '2. Sign a lease at the best property for your needs'],
            ['home', 'Services – Item 2 description', 'home.services.item2_desc', 'textarea', 'Our agents walk you through every step, matching you to the right property and making sure the terms work for your budget and lifestyle.'],
            ['home', 'Services – Item 3 title', 'home.services.item3_title', 'text', '3. Find the best deals and special offers'],
            ['home', 'Services – Item 3 description', 'home.services.item3_desc', 'textarea', "We track move-in specials, reduced deposits, and limited-time promotions so you never miss a saving before it's gone."],
            ['home', 'Services – Item 4 title', 'home.services.item4_title', 'text', '4. Save money on property fees and deposits'],
            ['home', 'Services – Item 4 description', 'home.services.item4_desc', 'textarea', 'Leverage our property manager relationships to negotiate lower deposits and waived fees — keeping more cash in your pocket from day one.'],

            ['home', 'Listings – Eyebrow', 'home.listings.eyebrow', 'text', 'Latest Listings'],
            ['home', 'Listings – Headline', 'home.listings.headline', 'text', 'Newest properties near UT Austin, ready to explore.'],

            ['home', 'Testimonials – Eyebrow', 'home.testi.eyebrow', 'text', 'Testimonials'],
            ['home', 'Testimonials – Headline', 'home.testi.headline', 'text', 'What students and owners say about Tower Leasing'],

            ['home', 'Why Choose Us – Eyebrow', 'home.why.eyebrow', 'text', 'Why Choose Us'],

            // ----- GLOBAL (footer, shown on every page) -----
            ['global', 'Footer – CTA heading', 'global.footer.cta_title', 'text', 'Ready to find your place near UT Austin?'],
            ['global', 'Footer – Brand blurb', 'global.footer.blurb', 'textarea', 'Helping UT Austin students find the perfect place to call home — exclusive listings, expert agents, always free for our clients.'],
            ['global', 'Footer – Office address', 'global.footer.address', 'html', '611 W 22nd St – second floor<br>(above Starbucks)<br>Austin, TX 78705'],
            ['global', 'Footer – Copyright', 'global.footer.copyright', 'text', 'Copyright © 2026 Tower Realty Austin, all rights reserved'],

            // ----- ABOUT PAGE -----
            ['about', 'Hero – Eyebrow', 'about.hero.eyebrow', 'text', 'About Us'],
            ['about', 'Hero – Title', 'about.hero.title', 'text', 'About Tower Leasing'],
            ['about', 'Hero – Lead', 'about.hero.lead', 'textarea', "At Tower Leasing, we specialize in connecting UT Austin students with the perfect place to call home. We know that finding an apartment on or near campus can be overwhelming, but we're here to take that burden off your shoulders and turn the process into an exciting and easy experience."],
            ['about', 'Features – Eyebrow', 'about.features.eyebrow', 'text', 'What we do for you'],
            ['about', 'Features – Title', 'about.features.title', 'text', 'Everything you need to land the right place — handled.'],
            ['about', 'Features – Item 1 title', 'about.features.item1_title', 'text', 'Get access to exclusive Tower Leasing listings'],
            ['about', 'Features – Item 1 description', 'about.features.item1_desc', 'textarea', "Tap into hundreds of curated near-campus apartments you won't find on any public rental site."],
            ['about', 'Features – Item 2 title', 'about.features.item2_title', 'text', 'Sign a lease at the best property for your needs'],
            ['about', 'Features – Item 2 description', 'about.features.item2_desc', 'textarea', 'Our agents match you to the right property and make sure the lease terms fit your budget and lifestyle.'],
            ['about', 'Features – Item 3 title', 'about.features.item3_title', 'text', 'Find the best deals and special offers'],
            ['about', 'Features – Item 3 description', 'about.features.item3_desc', 'textarea', 'We track move-in specials, reduced deposits, and limited-time promotions so you never miss a saving.'],
            ['about', 'Features – Item 4 title', 'about.features.item4_title', 'text', 'Save money on property fees and deposits'],
            ['about', 'Features – Item 4 description', 'about.features.item4_desc', 'textarea', 'Leverage our property-manager relationships to negotiate lower deposits and waived fees from day one.'],
            ['about', 'Split – Eyebrow', 'about.split.eyebrow', 'text', 'On campus, in your corner'],
            ['about', 'Split – Title', 'about.split.title', 'text', 'Right in the heart of West Campus'],
            ['about', 'Split – Text', 'about.split.text', 'textarea', "Our office sits at 22nd and Rio Grande — minutes from class. Pop in between lectures and we'll walk you through multiple tours in a single visit, then handle the paperwork so you can focus on school. From your first search to move-in day, you'll have a local team that knows the neighborhood inside out — and our help is always completely free for students."],
            ['about', 'Stats – Label 1', 'about.stats.stat1_label', 'text', 'Helping students since'],
            ['about', 'Stats – Label 2', 'about.stats.stat2_label', 'text', 'Exclusive near-campus options'],
            ['about', 'Stats – Label 3', 'about.stats.stat3_label', 'text', 'Helped into the right home'],

            // ----- AGENTS PAGE -----
            ['agents', 'Hero – Eyebrow', 'agents.hero.eyebrow', 'text', 'Our Team'],
            ['agents', 'Hero – Title', 'agents.hero.title', 'html', 'Experienced agents<br>you can trust'],
            ['agents', 'Hero – Lead', 'agents.hero.lead', 'textarea', 'Meet the Tower Team — licensed real estate agents with street-level knowledge of UT Austin housing, guiding thousands of students from search to signed lease, completely free.'],
            ['agents', 'Intro – Eyebrow', 'agents.intro.eyebrow', 'text', 'Who we are'],
            ['agents', 'Intro – Title', 'agents.intro.title', 'text', 'Meet the Tower Team'],
            ['agents', 'Intro – Paragraph 1', 'agents.intro.para1', 'textarea', 'The Tower Leasing team is a group of licensed real estate agents who help thousands of clients find housing around The University of Texas at Austin every year. Not only do we have "street level" knowledge — expert knowledge of every block near campus — but we know our properties inside and out.'],
            ['agents', 'Intro – Paragraph 2', 'agents.intro.para2', 'textarea', "Our sister company, Tower Management Austin, manages all of the properties listed on our site, so you're in good hands not only during the leasing process but after, when you actually live in the property. When you set up a tour, one of our agents will assist you from start to finish — and our help is always completely free for students."],

            // ----- CONTACT PAGE -----
            ['contact', 'Hero – Eyebrow', 'contact.hero.eyebrow', 'text', 'Contact'],
            ['contact', 'Hero – Title', 'contact.hero.title', 'text', "Let's get you home"],
            ['contact', 'Hero – Lead', 'contact.hero.lead', 'textarea', 'Booking a tour, asking about a listing, or ready to sign? Our West Campus team is a quick call or message away — and our help is always completely free for students.'],
            ['contact', 'Info – Eyebrow', 'contact.info.eyebrow', 'text', 'Reach us'],
            ['contact', 'Info – Title', 'contact.info.title', 'text', 'Get in touch'],
            ['contact', 'Info – Lead', 'contact.info.lead', 'textarea', "Drop by the office between classes, give us a ring, or send a note below — whichever's easiest. We'll line up tours and walk you through every step."],

            // ----- BECOME A LEASING AGENT PAGE -----
            ['become-agent', 'Hero – Eyebrow', 'become-agent.hero.eyebrow', 'html', 'Now Hiring - Part-Time &amp; Full-Time'],
            ['become-agent', 'Hero – Title', 'become-agent.hero.title', 'text', 'Launch your real estate career at UT Austin.'],
            ['become-agent', 'Hero – Lead', 'become-agent.hero.lead', 'textarea', 'Are you a UT Austin student looking for extra income? Do you love meeting new people? Work in a fast-paced, rewarding environment with high earning potential and a flexible schedule.'],

            // ----- PROPERTIES PAGE -----
            ['properties', 'Hero – Eyebrow', 'properties.hero.eyebrow', 'text', 'Exclusive Listings'],
            ['properties', 'Hero – Title', 'properties.hero.title', 'text', 'About Our Properties'],
            ['properties', 'Hero – Paragraph 1', 'properties.hero.lead1', 'textarea', "Tower Leasing's exclusive listings cater to students looking to save money while living in quality spaces. Our properties are individually owned and are managed by a small, dedicated team of UT alumni (hook 'em!) — all of whom are experienced and highly qualified property managers."],
            ['properties', 'Hero – Paragraph 2', 'properties.hero.lead2', 'textarea', "Whether you want to cozy up in a spacious one bedroom loft (fireplace &amp; parking included) or a larger house perfect for you and your friends to throw epic parties, Tower Leasing's exclusive listings has the perfect space for every student."],
        ];

        foreach ($items as $i => [$group, $label, $key, $type, $value]) {
            SiteContent::updateOrCreate(
                ['key' => $key],
                ['group' => $group, 'label' => $label, 'type' => $type, 'sort' => $i, 'value' => $value],
            );
        }
    }
}
