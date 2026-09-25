<?php
if (!defined('ABSPATH')) exit;

return [
    'slug'     => 'electrical-residential-proposal',
    'title'    => 'Residential Electrical Proposal — Panel Upgrade, EV Charger, Generator',
    'industry' => 'electrical',
    'type'     => 'proposal',
    'summary'  => 'A homeowner-friendly electrical proposal you can use for a panel or service upgrade, a Level 2 EV charger, a whole-home standby generator, or any combination — with a load calculation summary, good/better/best options, utility coordination, permits, warranty, rebates, timeline, and signature block.',
    'use_when' => [
        'Upgrading an undersized or outdated panel or service (for example 100A to 200A) in an owner-occupied home',
        'Installing a Level 2 EV charger, whether plug-in (NEMA 14-50) or hardwired',
        'Installing a whole-home or essential-circuit standby generator with an automatic transfer switch',
        'Bundling several of these into one project where the load calculation drives the options',
    ],
    'length'   => '4–7 pages',

    'fields' => [
        'firm_name'         => 'Your company name',
        'contact_name'      => 'Your name',
        'contact_title'     => 'Your title',
        'firm_phone'        => 'Phone',
        'firm_email'        => 'Email',
        'firm_address'      => 'Office address',
        'firm_website'      => 'Website',
        'license_number'    => 'License number(s)',
        'client_name'       => 'Client / owner name',
        'project_location'  => 'Project address or location',
        'proposal_date'     => 'Proposal date',
        'utility_name'      => 'Electric utility name',
        'proposal_valid_days' => 'Proposal valid for (days)',
    ],

    'checklist' => [
        'Photos attached of the existing panel (cover off, if safe), meter base, service drop or lateral, and main breaker rating',
        'Load calculation completed per NEC Article 220 (standard or optional method) and the result stated in amps',
        'Panel make and model checked for known-problem equipment and noted plainly (without scare language) if present',
        'Utility requirements confirmed — disconnect/reconnect scheduling, meter base spec, service upgrade application, and any utility fees',
        'EV charger: vehicle onboard charger rating, charger amperage, circuit size (125% continuous load), and install location/run length confirmed',
        'EV charger: plug-in vs. hardwired choice explained, including GFCI requirement for a NEMA 14-50 receptacle in a garage',
        'Generator: sizing basis (whole-home vs. essential circuits), load management, fuel type, gas meter/regulator capacity, and setback clearances confirmed',
        'Generator: permit, gas line, concrete pad, and manufacturer registration responsibilities are clear',
        'Surge protection, AFCI/GFCI updates, and grounding/bonding corrections included or offered as options — not surprises later',
        'Drywall patching, painting, and landscaping restoration clearly marked included or excluded',
        'Rebates, utility incentives, and federal tax credit lines are placeholders the customer is told to verify — no guaranteed amounts',
        'Options table totals, deposit, and progress payments add up correctly',
        'Power-outage window on install day stated in hours so the homeowner can plan',
        'License number, insurance, and proposal expiration date shown',
    ],

    'sections' => [
        [
            'heading' => 'Cover Letter',
            'tip'     => 'Open with what the homeowner told you they want — "charge two EVs overnight," "keep the sump pump and fridge running in an outage" — then confirm you can do it. Keep it to three short paragraphs; the details come later.',
            'body'    => <<<'HTML'
<p>{{proposal_date}}</p>
<p>{{client_name}}<br>{{project_location}}</p>
<p>Dear {{client_name}},</p>
<p>Thank you for having us out on [Date of site visit] to look at your home's electrical system. You told us your goals are [goal 1 — e.g., install a Level 2 charger for your new EV], [goal 2 — e.g., stop tripping breakers when the dryer and AC run together], and [goal 3 — e.g., keep essential circuits powered during outages].</p>
<p>This proposal summarizes what we found, the load calculation that tells us what your service can handle, and [Number] options so you can choose the right fit for your budget. Every option includes permits, inspection, utility coordination, and cleanup.</p>
<p>If you have any questions, call or text me directly at {{firm_phone}}. We look forward to working with you.</p>
<p>Sincerely,</p>
<p>{{contact_name}}<br>{{contact_title}}, {{firm_name}}<br>{{firm_email}} | {{firm_website}}<br>License No. {{license_number}}</p>
HTML,
        ],
        [
            'heading' => 'What We Found',
            'tip'     => 'Homeowners trust what they can see — reference photo numbers for each finding. Describe conditions factually (e.g., "no main bonding jumper visible," "double-tapped breaker") and explain why it matters in one plain sentence; avoid fear-based language, which reads as a sales tactic.',
            'body'    => <<<'HTML'
<table>
<thead>
<tr><th>Item</th><th>Existing condition</th><th>Why it matters</th><th>Photo</th></tr>
</thead>
<tbody>
<tr><td>Service size</td><td>[e.g., 100A, 120/240V single-phase, overhead service]</td><td>[e.g., Load calculation shows it is at or near capacity with the planned additions]</td><td>[#1]</td></tr>
<tr><td>Main panel</td><td>[Make / model / approximate age — number of spaces, spaces available]</td><td>[e.g., No open spaces for a 240V circuit; tandem breakers already in use]</td><td>[#2]</td></tr>
<tr><td>Meter base</td><td>[Condition / rating]</td><td>[e.g., Rated 100A; utility requires replacement for a 200A upgrade]</td><td>[#3]</td></tr>
<tr><td>Grounding and bonding</td><td>[e.g., Single ground rod; no bonding to gas piping visible]</td><td>[e.g., Current code requires a supplemental electrode and bonding]</td><td>[#4]</td></tr>
<tr><td>Branch circuit protection</td><td>[e.g., No AFCI protection; GFCI missing in garage]</td><td>[e.g., Required for circuits we modify or extend]</td><td>[#5]</td></tr>
<tr><td>Surge protection</td><td>[None / existing type]</td><td>[e.g., Protects electronics, appliances, and EV charger]</td><td>—</td></tr>
<tr><td>Other observations</td><td>[e.g., double-tapped breakers, aluminum branch wiring, scorched lugs]</td><td>[Plain-language explanation]</td><td>[#6]</td></tr>
</tbody>
</table>
HTML,
        ],
        [
            'heading' => 'Load Calculation Summary',
            'tip'     => 'A written load calculation is what separates a professional proposal from a guess, and many jurisdictions require one for a service upgrade or a large new load. Use NEC Article 220 (the optional method in 220.82 is common for dwellings) and show the result in amps against the service rating. If you are proposing load management instead of an upgrade, explain it here.',
            'body'    => <<<'HTML'
<p>We calculated your home's electrical demand using the [NEC 220.82 optional method / NEC standard method] per the [Year] National Electrical Code as adopted by [Jurisdiction].</p>
<table>
<thead>
<tr><th>Load</th><th>Existing (VA)</th><th>With proposed additions (VA)</th></tr>
</thead>
<tbody>
<tr><td>General lighting and receptacles ([Number] sq ft × 3 VA)</td><td>[Number]</td><td>[Number]</td></tr>
<tr><td>Small appliance and laundry circuits</td><td>[Number]</td><td>[Number]</td></tr>
<tr><td>Range / cooktop / oven</td><td>[Number]</td><td>[Number]</td></tr>
<tr><td>Dryer</td><td>[Number]</td><td>[Number]</td></tr>
<tr><td>Water heater</td><td>[Number]</td><td>[Number]</td></tr>
<tr><td>Heating / air conditioning (larger of)</td><td>[Number]</td><td>[Number]</td></tr>
<tr><td>EV charger ([Number]A circuit)</td><td>—</td><td>[Number]</td></tr>
<tr><td>[Other — hot tub, well pump, shop equipment]</td><td>[Number]</td><td>[Number]</td></tr>
<tr><td><strong>Calculated demand</strong></td><td><strong>[Number] A</strong></td><td><strong>[Number] A</strong></td></tr>
<tr><td><strong>Service rating</strong></td><td><strong>[Number] A</strong></td><td><strong>[Number] A (proposed)</strong></td></tr>
</tbody>
</table>
<p><strong>What this means:</strong> [e.g., Your existing 100A service would be at [Number]% of its capacity with the EV charger added, which leaves no margin. A 200A service provides room for the charger, a future heat pump, and other additions. / Your existing service can support the charger if we add an EV load management device that reduces charging when the house is using more power.]</p>
HTML,
        ],
        [
            'heading' => 'Recommended Scope of Work',
            'tip'     => 'Break the scope into the three possible project components and delete the ones that do not apply. Be specific about equipment ratings (amperage, number of spaces, generator kW, charger amperage) so the homeowner can compare apples to apples if they get other bids.',
            'body'    => <<<'HTML'
<h4>Panel / service upgrade</h4>
<ul>
<li>Coordinate with {{utility_name}} to disconnect and reconnect service; submit the service upgrade request</li>
<li>Replace the meter base with a [Amperage]A meter base [/ meter-main combination] per {{utility_name}} requirements</li>
<li>Replace service entrance conductors [and weatherhead / mast] as required</li>
<li>Install a new [Amperage]A main breaker panel, [Number] spaces, [Brand — or equivalent], with [whole-home surge protective device]</li>
<li>Transfer all existing circuits, label a typed panel directory, and replace [breakers / add AFCI/GFCI protection] where required by code for modified circuits</li>
<li>Upgrade grounding electrode system and bonding (ground rods, water and gas bonding) to current code</li>
</ul>
<h4>EV charger</h4>
<ul>
<li>Install a [Number]A, 240V circuit from the panel to [location — e.g., garage, left of the overhead door], approximately [Number] ft</li>
<li>[Option A: NEMA 14-50 receptacle with GFCI protection as required by code / Option B: hardwired Level 2 charger, [Brand/model — or customer-supplied], set to [Number]A output]</li>
<li>Circuit sized at 125% of the charger's continuous load as required by the NEC</li>
<li>[Configure Wi-Fi / app connectivity and utility time-of-use scheduling if supported]</li>
</ul>
<h4>Standby generator</h4>
<ul>
<li>Furnish and install a [Number] kW [natural gas / propane] air-cooled standby generator, [Brand — or equivalent]</li>
<li>Install a [Amperage]A [service-rated whole-home / essential-circuit] automatic transfer switch (ATS) [with load management modules for AC / range / EV charger]</li>
<li>Set generator on a [composite / concrete] pad at [location] meeting manufacturer and code clearances from windows, doors, vents, and property lines</li>
<li>Gas connection by [our licensed gas fitter / licensed plumbing partner]: [Number] ft of gas line from meter, with gas utility confirmation that the meter and regulator can supply the added load</li>
<li>Start-up, exercise schedule setup, owner walkthrough, and manufacturer warranty registration</li>
</ul>
HTML,
        ],
        [
            'heading' => 'Your Options',
            'tip'     => 'Three options is the sweet spot — most homeowners pick the middle one, so make sure it is the one you would recommend. Show what is different between tiers in plain rows, not just prices, and keep each tier a complete, code-compliant job (never a "good" option that cuts corners).',
            'body'    => <<<'HTML'
<table>
<thead>
<tr><th></th><th>Option 1 — Essential</th><th>Option 2 — Recommended</th><th>Option 3 — Premium</th></tr>
</thead>
<tbody>
<tr><td>Service / panel</td><td>[Keep existing service; add EV load management device]</td><td>[200A service and panel upgrade]</td><td>[200A upgrade with smart panel / circuit-level monitoring]</td></tr>
<tr><td>EV charging</td><td>[NEMA 14-50 receptacle, 50A circuit]</td><td>[Hardwired 48A Level 2 charger, 60A circuit]</td><td>[Hardwired 48A charger + prewire for second EV]</td></tr>
<tr><td>Standby power</td><td>[Generator inlet and interlock kit for portable generator]</td><td>[[Number] kW standby generator, essential-circuit ATS]</td><td>[[Number] kW standby generator, whole-home ATS with load management]</td></tr>
<tr><td>Surge protection</td><td>[Not included]</td><td>[Whole-home Type 2 SPD]</td><td>[Whole-home SPD + point-of-use protection]</td></tr>
<tr><td>Workmanship warranty</td><td>[Number] year(s)</td><td>[Number] years</td><td>[Number] years</td></tr>
<tr><td>Installation time</td><td>[Number] day(s)</td><td>[Number] days</td><td>[Number] days</td></tr>
<tr><td><strong>Investment</strong></td><td><strong>$[Amount]</strong></td><td><strong>$[Amount]</strong></td><td><strong>$[Amount]</strong></td></tr>
<tr><td>Estimated rebates / incentives (to be verified)</td><td>$[Amount]</td><td>$[Amount]</td><td>$[Amount]</td></tr>
<tr><td>Financing example</td><td>$[Amount]/mo for [Number] months</td><td>$[Amount]/mo for [Number] months</td><td>$[Amount]/mo for [Number] months</td></tr>
</tbody>
</table>
<h4>Optional add-ons</h4>
<table>
<thead>
<tr><th>Add-on</th><th>Price</th></tr>
</thead>
<tbody>
<tr><td>Whole-home surge protective device (if not in selected option)</td><td>$[Amount]</td></tr>
<tr><td>Generator annual maintenance plan (oil, filters, battery test, load test)</td><td>$[Amount]/yr</td></tr>
<tr><td>Replace remaining standard receptacles with tamper-resistant devices</td><td>$[Amount]</td></tr>
<tr><td>Dedicated circuit for future [heat pump / induction range / hot tub]</td><td>$[Amount]</td></tr>
</tbody>
</table>
HTML,
        ],
        [
            'heading' => 'Utility Coordination',
            'tip'     => 'Utility scheduling is usually what drives the timeline on a service upgrade, and homeowners rarely know it. Explain who applies, how long the utility typically takes in your area, and how long the power will be off. If the utility charges a fee or requires the homeowner to trim trees near the service drop, say so here.',
            'body'    => <<<'HTML'
<p>A service upgrade requires {{utility_name}} to disconnect power, inspect, and reconnect. We handle this for you:</p>
<ol>
<li>We submit the service upgrade / work request to {{utility_name}} within [Number] business days of your signed approval.</li>
<li>{{utility_name}} reviews the request, which typically takes [Number] to [Number] weeks in our area. [They may send a field representative to review the service location.]</li>
<li>On installation day, {{utility_name}} [or our crew, where permitted] disconnects service. Expect power to be off for approximately [Number] hours.</li>
<li>After the local inspector approves the work, {{utility_name}} reconnects and sets the meter — usually the same day, [or within [Number] days if a separate reconnect is required].</li>
</ol>
<p><strong>Customer responsibilities:</strong> [e.g., Clear access to the meter and panel; trim trees near the overhead service drop if required by the utility; pay any utility fees of approximately $[Amount] billed directly by {{utility_name}}.]</p>
<p>For generator installations, we will also coordinate with [Gas utility name] to confirm the gas meter and regulator can supply the generator at full load. If a meter upgrade is needed, that is scheduled by the gas utility.</p>
HTML,
        ],
        [
            'heading' => 'Permits and Inspections',
            'tip'     => 'Say plainly that the permit is in your name and included in the price — unpermitted electrical work can create problems with insurance claims and home sales, and homeowners appreciate knowing you do it right. List the inspections so they know when someone will need access.',
            'body'    => <<<'HTML'
<p>{{firm_name}} pulls all required electrical permits under our license and schedules all inspections. Permit fees are included in your price.</p>
<table>
<thead>
<tr><th>Permit / inspection</th><th>Issued by</th><th>When</th></tr>
</thead>
<tbody>
<tr><td>Electrical permit</td><td>[City / county building department]</td><td>Before work starts</td></tr>
<tr><td>Rough / service inspection</td><td>[Jurisdiction]</td><td>[Installation day or next business day]</td></tr>
<tr><td>Gas permit and inspection (generator)</td><td>[Jurisdiction]</td><td>[After gas line installation]</td></tr>
<tr><td>Final electrical inspection</td><td>[Jurisdiction]</td><td>After completion</td></tr>
<tr><td>[HOA approval for generator placement, if applicable]</td><td>[HOA — customer to submit; we provide spec sheets and site plan]</td><td>Before permit</td></tr>
</tbody>
</table>
<p>All work will be performed to the [Year] National Electrical Code as adopted by [Jurisdiction], local amendments, and {{utility_name}} service requirements. We will provide copies of the approved final inspection for your records.</p>
HTML,
        ],
        [
            'heading' => 'What\'s Included',
            'tip'     => 'This is where you prevent the "I thought that was included" conversation. Be specific about drywall — most service upgrades and new runs need small access holes, and whether you patch them (and whether you paint) is the most common dispute.',
            'body'    => <<<'HTML'
<p>Every option includes:</p>
<ul>
<li>All labor by licensed electricians employed by {{firm_name}} [— no subcontracting except licensed gas fitting, where noted]</li>
<li>All materials, equipment, and wire listed in the scope, new and UL-listed</li>
<li>Permits, inspections, and utility coordination</li>
<li>Typed panel directory identifying every circuit</li>
<li>Protection of floors and work areas with drop cloths and shoe covers</li>
<li>Removal and disposal of old panel, meter base, and debris</li>
<li>[Rough patching of access holes in drywall; finish texture and painting are not included]</li>
<li>Walkthrough of your new equipment, including charger app setup and generator operation</li>
</ul>
<h4>Not included</h4>
<ul>
<li>Utility company fees billed directly to you, if any</li>
<li>Finish drywall texture, painting, or wallpaper repair</li>
<li>Correction of existing code issues outside the scope, unless listed as an option (we will point out anything we find)</li>
<li>Landscaping restoration beyond backfilling trenches [and reseeding]</li>
<li>[Tree trimming near the service drop]</li>
<li>[Customer-supplied equipment warranty — manufacturer warranty only]</li>
</ul>
HTML,
        ],
        [
            'heading' => 'Rebates, Incentives, and Tax Credits',
            'tip'     => 'Incentive programs change often, so present them as possibilities for the customer to verify — never promise an amount or give tax advice. List the program name and where to check. Utility EV and panel programs sometimes require pre-approval before installation, so flag that timing clearly.',
            'body'    => <<<'HTML'
<p>You may be eligible for the following programs. Amounts, eligibility, and availability are set by each program and can change; please confirm with the program administrator and your tax professional.</p>
<table>
<thead>
<tr><th>Program</th><th>Applies to</th><th>Estimated amount</th><th>Who applies / timing</th></tr>
</thead>
<tbody>
<tr><td>{{utility_name}} EV charger rebate [program name]</td><td>[Level 2 charger — may require a qualified/networked model]</td><td>$[Amount]</td><td>[Customer — may require pre-approval before install]</td></tr>
<tr><td>{{utility_name}} [EV time-of-use rate or make-ready program name]</td><td>[Panel / wiring for EV charging]</td><td>[$Amount or rate description]</td><td>[We provide invoice and photos]</td></tr>
<tr><td>[State or local electrification / panel upgrade incentive]</td><td>[Service upgrade in connection with electrification]</td><td>$[Amount]</td><td>[Customer / contractor — confirm]</td></tr>
<tr><td>[Federal tax credit — name of credit, if currently available]</td><td>[Qualifying equipment]</td><td>[percentage]% up to $[Amount]</td><td>[Customer — consult tax professional]</td></tr>
</tbody>
</table>
<p>We will provide itemized invoices, equipment spec sheets, and photos to support your applications.</p>
HTML,
        ],
        [
            'heading' => 'Project Timeline',
            'tip'     => 'Give homeowners a realistic sequence with the outage window called out. Generator lead times and utility scheduling can each add weeks, so state them as ranges and update the customer if either changes.',
            'body'    => <<<'HTML'
<table>
<thead>
<tr><th>Step</th><th>Timing</th></tr>
</thead>
<tbody>
<tr><td>Proposal accepted and deposit received</td><td>Day 0</td></tr>
<tr><td>Permit applications and utility request submitted</td><td>Within [Number] business days</td></tr>
<tr><td>Equipment ordered (generator lead time [Number]–[Number] weeks)</td><td>Within [Number] business days</td></tr>
<tr><td>Utility and permit approvals received</td><td>[Number]–[Number] weeks</td></tr>
<tr><td>Installation day(s) — power off approximately [Number] hours</td><td>[Number] day(s)</td></tr>
<tr><td>Inspection and utility reconnect</td><td>[Same day / within Number days]</td></tr>
<tr><td>Generator start-up, charger setup, and walkthrough</td><td>[Same day as final / within Number days]</td></tr>
</tbody>
</table>
<p>Please plan for any refrigerated medications, medical equipment, home offices, or security systems during the power-off window. We will confirm your install date at least [Number] days in advance.</p>
HTML,
        ],
        [
            'heading' => 'Warranty',
            'tip'     => 'Separate your workmanship warranty from manufacturer warranties, and note that generator warranties usually require registration and regular maintenance. A longer workmanship warranty is a genuine differentiator, but only offer what you will honor.',
            'body'    => <<<'HTML'
<ul>
<li><strong>Workmanship:</strong> {{firm_name}} warrants our installation workmanship for [Number] year(s) from completion. If a problem results from our work, we will fix it at no charge.</li>
<li><strong>Panel and breakers:</strong> Manufacturer warranty of [Number] years — [Manufacturer].</li>
<li><strong>EV charger:</strong> Manufacturer warranty of [Number] years — [Manufacturer]. Customer-supplied chargers carry only the manufacturer's warranty.</li>
<li><strong>Standby generator:</strong> [Number]-year limited manufacturer warranty — [Manufacturer]. Registration is completed by us at start-up; the warranty may require periodic maintenance, which our maintenance plan covers.</li>
<li><strong>Surge protective device:</strong> [Manufacturer warranty terms, including any connected-equipment coverage, as stated by the manufacturer].</li>
</ul>
<p>Warranty does not cover damage from lightning beyond the SPD rating, utility surges, flooding, physical damage, or modifications made by others.</p>
HTML,
        ],
        [
            'heading' => 'Why Choose Us',
            'tip'     => 'Keep this short and factual: licensed employees, years in business, reviews count, and one or two nearby jobs. Homeowners are comparing you against a lower bid — this section is where you justify the difference.',
            'body'    => <<<'HTML'
<ul>
<li>Licensed electrical contractor ({{license_number}}), fully insured, serving [Service area] since [Year]</li>
<li>[Number] licensed electricians on staff — [all background-checked and drug-tested]</li>
<li>[Manufacturer dealer / installer certification — e.g., authorized generator dealer — name the brand only if you hold it]</li>
<li>[Number]+ [panel upgrades / EV chargers / generators] installed in [Region]</li>
<li>[Average rating] from [Number] reviews on [Review platform]</li>
<li>Recent nearby project: [Neighborhood — brief description — customer first name / reference available on request]</li>
</ul>
HTML,
        ],
        [
            'heading' => 'Payment Terms and Financing',
            'tip'     => 'Deposits are commonly 10–50% depending on equipment cost and state rules — some states cap residential deposits, so check yours. Tie progress payments to milestones the homeowner can see, and note that final payment is due after passed inspection.',
            'body'    => <<<'HTML'
<table>
<thead>
<tr><th>Payment</th><th>When due</th><th>Amount</th></tr>
</thead>
<tbody>
<tr><td>Deposit</td><td>At signing</td><td>[percentage]% — $[Amount]</td></tr>
<tr><td>Progress payment</td><td>[On equipment delivery / installation day]</td><td>[percentage]% — $[Amount]</td></tr>
<tr><td>Final payment</td><td>Upon passed final inspection</td><td>[percentage]% — $[Amount]</td></tr>
</tbody>
</table>
<p>We accept [check, ACH, and major credit cards — note any card fee]. Financing is available through [Financing partner], subject to credit approval, with plans such as [Number] months at [percentage]% APR. Ask us for a pre-qualification link.</p>
<p><strong>Terms summary:</strong> Prices include materials, labor, permits, and inspections as described. Changes to the scope will be documented in a written change order signed before work proceeds. Concealed conditions not reasonably visible at the time of our visit (for example, damaged wiring inside walls) will be reported and priced before any additional work is done. [State-required notice — e.g., right to cancel within 3 business days — insert as required by your state.]</p>
HTML,
        ],
        [
            'heading' => 'Acceptance',
            'tip'     => 'Make it easy to say yes: have the customer initial the chosen option, sign, and date. If you offer e-signature, say so. Always include the proposal expiration date, because equipment pricing moves.',
            'body'    => <<<'HTML'
<p>This proposal is valid for {{proposal_valid_days}} days from {{proposal_date}}.</p>
<p>Please initial the option you select:</p>
<p>____ Option 1 — Essential — $[Amount]<br>____ Option 2 — Recommended — $[Amount]<br>____ Option 3 — Premium — $[Amount]<br>____ Add-ons: [List] — $[Amount]</p>
<p><strong>Total accepted amount:</strong> $____________</p>
<p>By signing below, I authorize {{firm_name}} to perform the work described for the option selected, under the terms stated in this proposal.</p>
<p>Customer signature: ______________________________ Date: ____________<br>Printed name: {{client_name}}<br>Address: {{project_location}}</p>
<p>{{firm_name}} representative: ______________________________ Date: ____________<br>{{contact_name}}, {{contact_title}}<br>{{firm_address}} | {{firm_phone}} | License No. {{license_number}}</p>
HTML,
        ],
    ],
];
