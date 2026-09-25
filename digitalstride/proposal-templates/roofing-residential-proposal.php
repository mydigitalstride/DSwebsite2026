<?php
if (!defined('ABSPATH')) exit;

return [
    'slug'     => 'roofing-residential-proposal',
    'title'    => 'Residential Re-Roof Proposal',
    'industry' => 'roofing',
    'type'     => 'proposal',
    'summary'  => 'A homeowner-ready re-roof proposal with photo-based inspection findings, a good/better/best system table, decking replacement unit price, ventilation plan, a clear list of what is included, an insurance-claim process overview, warranty, financing, timeline, and signature block.',
    'use_when' => [
        'Replacing an aging, leaking, or storm-damaged asphalt shingle roof on a single-family home',
        'The homeowner wants to compare shingle and underlayment options at different price points',
        'The job may involve an insurance claim and the homeowner needs to understand the process and who does what',
        'You want to set expectations up front on decking replacement, ventilation corrections, and cleanup',
    ],
    'length'   => '5–8 pages plus photos',

    'fields' => [
        'firm_name'           => 'Your company name',
        'contact_name'        => 'Your name',
        'contact_title'       => 'Your title',
        'firm_phone'          => 'Phone',
        'firm_email'          => 'Email',
        'firm_address'        => 'Office address',
        'firm_website'        => 'Website',
        'license_number'      => 'License number(s)',
        'client_name'         => 'Client / owner name',
        'project_location'    => 'Project address or location',
        'proposal_date'       => 'Proposal date',
        'roof_squares'        => 'Roof size (squares)',
        'proposal_valid_days' => 'Proposal valid for (days)',
    ],

    'checklist' => [
        'Inspection photos labeled and numbered, including overall elevations, close-ups of damage, attic/decking views, and ventilation',
        'Roof measured (drone, aerial report, or hand measure) and squares stated, with waste factor noted',
        'Number of existing layers confirmed — code generally allows no more than two, and many manufacturers require tear-off for full warranty',
        'Decking replacement unit price per sheet stated, with an estimate of sheets included (if any)',
        'Ventilation calculated (net free area, intake balanced with exhaust) and the proposed changes listed',
        'Ice and water shield locations match local code and climate (eaves, valleys, penetrations, low-slope areas)',
        'Shingle wind rating and impact rating (if offered) stated accurately from the manufacturer\'s published data',
        'Manufacturer system warranty requirements met for each tier (certified installer status, required accessories, registration)',
        'Flashing plan specified: drip edge, step flashing, chimney counterflashing, pipe boots — replaced, not reused, unless stated',
        'Gutters, skylights, satellite dishes, and solar panels marked included, excluded, or optional',
        'Insurance section describes process only — no promises of coverage, no advice on the claim, and complies with state rules on contractor involvement',
        'Permit fees, dumpster, and cleanup (including magnetic nail sweep) are included in the price',
        'Payment schedule and deposit comply with state rules, and any required right-to-cancel notice is attached',
        'Financing figures are marked as examples subject to credit approval',
        'License, insurance certificate, and proposal expiration date included',
    ],

    'sections' => [
        [
            'heading' => 'Cover Letter',
            'tip'     => 'Reference the date of your inspection and what the homeowner told you — a leak over the kitchen, a storm, selling the house. Keep it short and personal; the photos and options do the selling.',
            'body'    => <<<'HTML'
<p>{{proposal_date}}</p>
<p>{{client_name}}<br>{{project_location}}</p>
<p>Dear {{client_name}},</p>
<p>Thank you for having {{firm_name}} inspect your roof on [Date of inspection]. You mentioned [homeowner's concern — e.g., a leak in the upstairs bedroom after the storm on [Date] / the roof is original to the home and you plan to stay long term].</p>
<p>This proposal includes what we found (with photos), our recommendation, three roofing system options, and exactly what is included in the price. We also explain how the process works if you are filing an insurance claim.</p>
<p>Please call or text me at {{firm_phone}} with any questions. We would be glad to walk through the options with you in person.</p>
<p>Sincerely,</p>
<p>{{contact_name}}<br>{{contact_title}}, {{firm_name}}<br>{{firm_email}} | {{firm_website}}<br>License No. {{license_number}}</p>
HTML,
        ],
        [
            'heading' => 'Inspection Findings',
            'tip'     => 'Photos are the most persuasive part of a roofing proposal — number them and reference each one. Describe what you saw factually (granule loss, creased tabs, exposed nail heads, soft decking) and avoid overstating storm damage; if an adjuster later disagrees with you, your credibility with the homeowner suffers.',
            'body'    => <<<'HTML'
<table>
<thead>
<tr><th>Area</th><th>What we found</th><th>What it means</th><th>Photo(s)</th></tr>
</thead>
<tbody>
<tr><td>Shingles</td><td>[e.g., 3-tab asphalt, approx. [Number] years old; granule loss, curling, [Number] missing / creased tabs on [slope]]</td><td>[e.g., Near end of service life; reduced water shedding]</td><td>[#1–#4]</td></tr>
<tr><td>Existing layers</td><td>[Number] layer(s)</td><td>[e.g., Tear-off to the deck is required for a new roof]</td><td>[#5]</td></tr>
<tr><td>Decking</td><td>[e.g., 7/16 in. OSB; soft areas at [location]; delamination seen from attic]</td><td>[e.g., Some sheets likely need replacement once exposed]</td><td>[#6]</td></tr>
<tr><td>Flashing</td><td>[e.g., Chimney counterflashing sealed with caulk only; rusted step flashing at sidewall]</td><td>[e.g., Common leak source; will be replaced]</td><td>[#7–#8]</td></tr>
<tr><td>Pipe boots and penetrations</td><td>[e.g., Cracked rubber collars on [Number] plumbing vents]</td><td>[e.g., Active leak risk]</td><td>[#9]</td></tr>
<tr><td>Valleys</td><td>[e.g., Worn shingles in open valley over [area]]</td><td>[Explanation]</td><td>[#10]</td></tr>
<tr><td>Ventilation</td><td>[e.g., Soffit vents painted over; [Number] box vents; attic temperature / moisture signs]</td><td>[e.g., Poor airflow shortens shingle life and can cause moisture in the attic]</td><td>[#11]</td></tr>
<tr><td>Gutters and drip edge</td><td>[e.g., No drip edge; gutters pulling away at [location]]</td><td>[Explanation]</td><td>[#12]</td></tr>
<tr><td>Interior / attic</td><td>[e.g., Water staining on rafters near chimney; ceiling stain in [room]]</td><td>[Explanation]</td><td>[#13]</td></tr>
</tbody>
</table>
<p><strong>Roof size:</strong> {{roof_squares}} squares (1 square = 100 sq ft), measured by [aerial report / drone / hand measurement], plus [percentage]% waste for [hips, valleys, and starter]. Pitch: [e.g., 6/12 main, 3/12 porch].</p>
HTML,
        ],
        [
            'heading' => 'Our Recommendation',
            'tip'     => 'Give a clear recommendation in two or three sentences and explain why. If a repair would genuinely work, say so — homeowners remember contractors who did not oversell them, and repair customers become re-roof customers later.',
            'body'    => <<<'HTML'
<p>Based on the age and condition of your roof, we recommend a [complete tear-off and replacement / repair of [specific area] at this time]. [e.g., The shingles are at the end of their service life, the flashing at the chimney and sidewall is failing, and the attic lacks balanced ventilation. Repairing individual leaks would not address the overall condition.]</p>
<p>A complete replacement lets us inspect and repair the decking, correct the ventilation, replace all flashing, and install a manufacturer system that qualifies for an enhanced warranty.</p>
<p>[If repair is an option:] If you prefer to wait, we can [describe repair — e.g., reflash the chimney and replace pipe boots] for $[Amount], which should address the current leak but will not extend the life of the shingles.</p>
HTML,
        ],
        [
            'heading' => 'Your Roofing Options',
            'tip'     => 'Keep all three tiers code-compliant and properly flashed — the differences should be product quality, underlayment, accessories, and warranty length, not whether the job is done right. Use the manufacturer\'s published wind and impact ratings exactly; some insurers offer discounts for Class 4 impact-rated shingles, but tell the homeowner to confirm with their agent.',
            'body'    => <<<'HTML'
<table>
<thead>
<tr><th></th><th>Good</th><th>Better (Recommended)</th><th>Best</th></tr>
</thead>
<tbody>
<tr><td>Shingle</td><td>[Manufacturer — standard architectural / laminated]</td><td>[Manufacturer — premium architectural]</td><td>[Manufacturer — impact-resistant (UL 2218 Class 4) or designer]</td></tr>
<tr><td>Wind rating (per manufacturer)</td><td>[Number] mph</td><td>[Number] mph [with enhanced nailing]</td><td>[Number] mph</td></tr>
<tr><td>Underlayment</td><td>[Synthetic underlayment]</td><td>[Premium synthetic underlayment]</td><td>[Premium synthetic / full-deck self-adhered]</td></tr>
<tr><td>Ice and water shield</td><td>[Eaves [Number] ft up-slope, valleys, and penetrations — per code]</td><td>[Eaves, valleys, penetrations, and sidewalls]</td><td>[Expanded coverage — [describe]]</td></tr>
<tr><td>Starter, hip, and ridge</td><td>[Manufacturer starter and hip/ridge]</td><td>[Manufacturer starter and high-profile hip/ridge]</td><td>[Manufacturer matched accessories]</td></tr>
<tr><td>Ventilation</td><td>[Ridge vent + clear existing soffit vents]</td><td>[Ridge vent + added intake to balance NFA]</td><td>[Balanced ridge and intake + attic moisture review]</td></tr>
<tr><td>Drip edge and flashing</td><td>[New drip edge; new step and pipe flashing]</td><td>[Same + new chimney counterflashing]</td><td>[Same + [upgraded metal — e.g., copper or pre-finished]]</td></tr>
<tr><td>Manufacturer warranty</td><td>[Standard limited warranty — [Number]-year non-prorated period]</td><td>[Enhanced system warranty — [Number] years non-prorated materials, [Number] years workmanship]</td><td>[Top-tier system warranty — terms]</td></tr>
<tr><td>{{firm_name}} workmanship warranty</td><td>[Number] years</td><td>[Number] years</td><td>[Number] years</td></tr>
<tr><td><strong>Price ({{roof_squares}} squares)</strong></td><td><strong>$[Amount]</strong></td><td><strong>$[Amount]</strong></td><td><strong>$[Amount]</strong></td></tr>
<tr><td>Financing example</td><td>$[Amount]/mo</td><td>$[Amount]/mo</td><td>$[Amount]/mo</td></tr>
</tbody>
</table>
<p>Shingle color: [Color name — customer to confirm from samples]. All prices include tear-off of [Number] layer(s), permits, disposal, and cleanup as described below.</p>
<h4>Optional upgrades</h4>
<table>
<thead>
<tr><th>Upgrade</th><th>Price</th></tr>
</thead>
<tbody>
<tr><td>New seamless gutters and downspouts ([Number] ft, [size and color])</td><td>$[Amount]</td></tr>
<tr><td>Gutter guards</td><td>$[Amount]</td></tr>
<tr><td>Replace skylight(s) with new [flashing kit / unit]</td><td>$[Amount] each</td></tr>
<tr><td>Replace low-slope section ([Number] sq ft) with [modified bitumen / TPO]</td><td>$[Amount]</td></tr>
<tr><td>Attic insulation top-up to R-[Number]</td><td>$[Amount]</td></tr>
</tbody>
</table>
HTML,
        ],
        [
            'heading' => 'Decking Replacement',
            'tip'     => 'Decking condition cannot be fully known until tear-off, so a clear per-sheet unit price prevents disputes. Many contractors include a small number of sheets in the base price; either way, commit to photographing replaced sheets and getting approval before exceeding the stated amount.',
            'body'    => <<<'HTML'
<p>Once the old roofing is removed, we will inspect every sheet of decking. Any rotted, delaminated, or damaged decking must be replaced so the new roof can be properly fastened and the manufacturer warranty will apply.</p>
<table>
<thead>
<tr><th>Item</th><th>Price</th></tr>
</thead>
<tbody>
<tr><td>Decking sheets included in the price above</td><td>[Number] sheets included</td></tr>
<tr><td>Additional 4 × 8 sheet, [7/16 in. OSB / 1/2 in. plywood / 5/8 in. plywood], installed</td><td>$[Amount] per sheet</td></tr>
<tr><td>Plank / board deck repair (older homes)</td><td>$[Amount] per linear foot</td></tr>
<tr><td>Re-nailing existing decking to current fastening requirements</td><td>[Included / $Amount]</td></tr>
<tr><td>Sheathing over spaced (skip) sheathing where required</td><td>$[Amount] per square</td></tr>
</tbody>
</table>
<p>We will photograph all replaced decking and notify you before replacing more than [Number] sheets. Replaced quantities will be shown on your final invoice.</p>
HTML,
        ],
        [
            'heading' => 'Ventilation Plan',
            'tip'     => 'Show the net free area (NFA) math — the common rule is 1 sq ft of NFA per 150 sq ft of attic floor, or 1:300 when balanced and code conditions are met, split roughly evenly between intake and exhaust. Never mix exhaust types (for example, ridge vents with gable fans or box vents) on the same attic space; it short-circuits airflow. Manufacturers often require proper ventilation for full warranty.',
            'body'    => <<<'HTML'
<p>Balanced attic ventilation removes heat and moisture, extends shingle life, and is required by most shingle manufacturers for full warranty coverage.</p>
<table>
<thead>
<tr><th></th><th>Existing</th><th>Proposed</th></tr>
</thead>
<tbody>
<tr><td>Attic floor area</td><td>[Number] sq ft</td><td>[Number] sq ft</td></tr>
<tr><td>Required net free area ([1:150 / 1:300])</td><td>[Number] sq in.</td><td>[Number] sq in.</td></tr>
<tr><td>Intake (soffit / eave)</td><td>[Type — NFA sq in.]</td><td>[e.g., Clear blocked soffits + add [Number] ft continuous soffit vent — NFA sq in.]</td></tr>
<tr><td>Exhaust</td><td>[e.g., [Number] box vents + gable vents — NFA sq in.]</td><td>[e.g., [Number] ft ridge vent — NFA sq in.; remove box vents]</td></tr>
<tr><td>Balance (intake : exhaust)</td><td>[Ratio]</td><td>[Target 50:50 or slightly intake-heavy]</td></tr>
</tbody>
</table>
<p>Existing [box vents / turbines] will be removed and the openings decked over so the ridge vent works as designed. [Bathroom and kitchen exhaust fans that currently vent into the attic will be vented through the roof with new exhaust caps — $[Amount] each / not included.]</p>
HTML,
        ],
        [
            'heading' => 'What\'s Included',
            'tip'     => 'This list is what separates you from the lowest bid — many low prices skip drip edge, reuse flashing, or charge extra for permits and dumpsters. Be explicit, and include protection of landscaping and the magnetic nail sweep; those are what homeowners remember.',
            'body'    => <<<'HTML'
<p>Every option includes:</p>
<h4>Preparation and protection</h4>
<ul>
<li>Building permit and required inspections</li>
<li>Protection of landscaping, AC units, decks, and siding with tarps; plywood over delicate areas as needed</li>
<li>Dumpster or dump trailer placed at [driveway location — on plywood to protect the surface]</li>
</ul>
<h4>Tear-off</h4>
<ul>
<li>Removal of all existing roofing layers ([Number]), underlayment, and old flashing down to the deck</li>
<li>Deck inspection and re-nailing; replacement per the decking unit price</li>
</ul>
<h4>Installation</h4>
<ul>
<li>New drip edge at eaves and rakes</li>
<li>Ice and water shield at eaves, valleys, and around all penetrations [and sidewalls] per code and manufacturer requirements</li>
<li>Synthetic underlayment over the remaining deck</li>
<li>Manufacturer starter strip, shingles, and hip and ridge caps, installed per manufacturer nailing instructions</li>
<li>New step flashing at walls and new counterflashing at chimney [cut into mortar joints / surface-mounted where required]</li>
<li>New pipe boots and vent flashings; new exhaust caps where listed</li>
<li>Ventilation per the plan above</li>
</ul>
<h4>Cleanup and closeout</h4>
<ul>
<li>Daily cleanup of debris; roof dried-in each night if work spans more than one day</li>
<li>Magnetic nail sweep of the driveway, lawn, and landscaped beds at completion</li>
<li>Gutters cleared of shingle debris</li>
<li>Final walkthrough with you and the crew lead</li>
<li>Manufacturer warranty registration and a closeout packet with photos, permit sign-off, and warranty documents</li>
</ul>
<h4>Not included</h4>
<ul>
<li>Interior drywall or paint repairs from past leaks</li>
<li>Gutter replacement, skylight replacement, and low-slope sections unless selected as upgrades</li>
<li>Removal and reinstallation of satellite dishes, solar panels, or antennas [— available by others / $Amount]</li>
<li>Structural repairs to rafters or trusses (will be reported and priced if found)</li>
</ul>
HTML,
        ],
        [
            'heading' => 'Insurance Claim Process',
            'tip'     => 'Explain process only — do not tell the homeowner what their policy covers, do not negotiate the claim on their behalf, and do not offer to waive or absorb the deductible, which is illegal in many states. Some states regulate what a roofer may say or do in a claim, so check your state\'s rules and remove anything that does not apply.',
            'body'    => <<<'HTML'
<p>If your roof damage may be covered by homeowner's insurance, here is how the process generally works and where {{firm_name}} fits in. Your insurance company decides what is covered; you should review your policy and direct coverage questions to your insurance agent or adjuster.</p>
<ol>
<li><strong>Document and report.</strong> You contact your insurance company to report the damage and receive a claim number. Our inspection photos and report are available for you to share.</li>
<li><strong>Adjuster inspection.</strong> The insurance company sends an adjuster to inspect the roof. At your request, a {{firm_name}} representative can attend to point out the conditions documented in our inspection.</li>
<li><strong>Review the estimate.</strong> The insurance company provides a written estimate (sometimes called a scope of loss). Policies may pay in stages — for example, an initial actual cash value (ACV) payment and a later recoverable depreciation payment toward replacement cost value (RCV) after work is complete — depending on your policy terms.</li>
<li><strong>Items not in the estimate.</strong> If we find damaged decking or code-required items during the work, we will document them with photos and measurements so you can submit them to your insurance company. Whether these are covered is the insurance company's decision.</li>
<li><strong>Deductible.</strong> Your deductible is your responsibility under your policy and is included in the amount owed to us.</li>
<li><strong>Payment.</strong> Insurance checks may be payable to you and your mortgage company. Payments to {{firm_name}} follow the payment schedule in this proposal.</li>
</ol>
<p>Our price for the work is the price in this proposal. If the insurance estimate differs from our price, we will review the differences with you before work begins so you can make an informed decision.</p>
HTML,
        ],
        [
            'heading' => 'Warranty',
            'tip'     => 'Explain the difference between the manufacturer\'s material warranty, an enhanced system warranty (which usually requires a certified installer and full system of that brand\'s accessories), and your own workmanship warranty. State whether coverage is prorated and whether it transfers to a future owner — both matter to homeowners who may sell.',
            'body'    => <<<'HTML'
<table>
<thead>
<tr><th>Warranty</th><th>Provided by</th><th>Term</th><th>Notes</th></tr>
</thead>
<tbody>
<tr><td>Shingle material — standard limited warranty</td><td>[Manufacturer]</td><td>[Term — e.g., limited lifetime with [Number]-year non-prorated period]</td><td>Covers manufacturing defects per manufacturer terms</td></tr>
<tr><td>Enhanced system warranty (Better and Best options)</td><td>[Manufacturer]</td><td>[Number] years non-prorated [materials and workmanship]</td><td>[Requires certified installer and full manufacturer system; transferable [once] per manufacturer terms]</td></tr>
<tr><td>Workmanship warranty</td><td>{{firm_name}}</td><td>[Number] years</td><td>We repair leaks caused by our installation at no charge</td></tr>
<tr><td>Wind and algae resistance</td><td>[Manufacturer]</td><td>[Terms]</td><td>[Per manufacturer published limits]</td></tr>
</tbody>
</table>
<p>{{firm_name}} is a [manufacturer certification level — only if held] for [Manufacturer]. We register your warranty with the manufacturer within [Number] days of completion and send you the certificate.</p>
<p>Warranties do not cover damage from storms beyond the rated wind speed, hail (unless an impact-rated product warranty applies), falling trees, foot traffic by others, or alterations made after installation by others.</p>
HTML,
        ],
        [
            'heading' => 'Project Timeline',
            'tip'     => 'Most single-family re-roofs take one to three days on site, but material delivery, permits, and weather drive the start date. Tell the homeowner what to do before install day — move cars, take pictures off walls, cover attic items — so there are no surprises.',
            'body'    => <<<'HTML'
<table>
<thead>
<tr><th>Step</th><th>Timing</th></tr>
</thead>
<tbody>
<tr><td>Proposal signed and deposit received</td><td>Day 0</td></tr>
<tr><td>Permit application submitted</td><td>Within [Number] business days</td></tr>
<tr><td>Materials ordered; color confirmed</td><td>Within [Number] business days</td></tr>
<tr><td>Materials delivered to your home</td><td>[Number] day(s) before start</td></tr>
<tr><td>Installation</td><td>[Number]–[Number] days, weather permitting</td></tr>
<tr><td>Final inspection and walkthrough</td><td>Within [Number] days of completion</td></tr>
</tbody>
</table>
<h4>Before install day</h4>
<ul>
<li>Move vehicles out of the garage and driveway</li>
<li>Remove wall hangings and fragile items on walls that share the roof framing — vibration from tear-off can shake them loose</li>
<li>Cover belongings stored in the attic; some dust and debris may fall through</li>
<li>Keep children and pets away from the work area during installation</li>
</ul>
HTML,
        ],
        [
            'heading' => 'Why Choose Us',
            'tip'     => 'Short, factual, and local. Use real review counts and certifications you actually hold. A nearby address the homeowner can drive by is often more convincing than any claim.',
            'body'    => <<<'HTML'
<ul>
<li>Licensed ({{license_number}}) and insured roofing contractor serving [Service area] since [Year]</li>
<li>[Manufacturer certification — name and level, only if held]</li>
<li>[Own crews / crew lead on site every day] — [Number] years average crew experience</li>
<li>[Average rating] from [Number] reviews on [Review platform]</li>
<li>[Number] roofs completed in [County / region]; recent nearby project at [Street name / neighborhood]</li>
<li>Local office at {{firm_address}} — we will be here for your warranty</li>
</ul>
HTML,
        ],
        [
            'heading' => 'Payment Terms and Financing',
            'tip'     => 'Keep the deposit reasonable and check your state\'s limits on residential deposits and required notices (such as a three-day right to cancel for home solicitation sales). Tie final payment to completion and walkthrough, not to the insurance company\'s timeline.',
            'body'    => <<<'HTML'
<table>
<thead>
<tr><th>Payment</th><th>When due</th><th>Amount</th></tr>
</thead>
<tbody>
<tr><td>Deposit</td><td>At signing</td><td>[percentage]% — $[Amount]</td></tr>
<tr><td>[Material payment]</td><td>[On material delivery]</td><td>[percentage]% — $[Amount]</td></tr>
<tr><td>Final payment</td><td>Upon completion and walkthrough</td><td>[percentage]% — $[Amount]</td></tr>
<tr><td>Additional decking / approved changes</td><td>With final payment</td><td>Per unit price / change order</td></tr>
</tbody>
</table>
<p>We accept [check, ACH, and major credit cards — note any card fee]. Financing is available through [Financing partner] subject to credit approval — for example, [Number] months at [percentage]% APR, or [same-as-cash promotional terms]. Monthly amounts shown in the options table are examples only.</p>
<p><strong>Terms summary:</strong> Work is performed as described in this proposal. Changes will be documented in a signed change order before work proceeds. Hidden conditions (such as rotted decking or structural damage) are priced per the unit prices above or reported to you before we proceed. Start dates depend on weather and material availability. [Insert any state-required notices, such as a right-to-cancel notice or lien law notice.]</p>
HTML,
        ],
        [
            'heading' => 'Acceptance',
            'tip'     => 'Have the homeowner initial the option and color and sign. Include the expiration date — shingle prices change several times a year. If both spouses or co-owners are on title, get both signatures if your state or lender requires it.',
            'body'    => <<<'HTML'
<p>This proposal is valid for {{proposal_valid_days}} days from {{proposal_date}}.</p>
<p>Please initial your selection:</p>
<p>____ Good — $[Amount]<br>____ Better (Recommended) — $[Amount]<br>____ Best — $[Amount]<br>____ Upgrades: [List] — $[Amount]</p>
<p>Shingle color: ______________________</p>
<p><strong>Total accepted amount:</strong> $____________ plus decking at $[Amount] per sheet beyond [Number] included sheets.</p>
<p>By signing, I authorize {{firm_name}} to perform the work described above for the selected option at {{project_location}}, under the terms in this proposal.</p>
<p>Homeowner signature: ______________________________ Date: ____________<br>Printed name: {{client_name}}</p>
<p>Co-owner signature (if applicable): ______________________________ Date: ____________</p>
<p>{{firm_name}}: ______________________________ Date: ____________<br>{{contact_name}}, {{contact_title}}<br>{{firm_address}} | {{firm_phone}} | License No. {{license_number}}</p>
HTML,
        ],
    ],
];
