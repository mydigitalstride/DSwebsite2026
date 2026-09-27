<?php
if (!defined('ABSPATH')) exit;

return [
    'slug'     => 'hvac-residential-proposal',
    'title'    => 'HVAC Residential System Replacement Proposal',
    'industry' => 'hvac',
    'type'     => 'proposal',
    'summary'  => 'A homeowner-friendly replacement proposal with inspection findings, Manual J load summary, a good/better/best comparison (SEER2, HSPF2, AFUE, warranty), what\'s included, rebates and tax-credit placeholders, financing, maintenance plan, timeline, and signature block.',
    'use_when' => [
        'Replacing a failed or aging furnace, air conditioner, or heat pump in an owner-occupied home',
        'The homeowner wants to compare several efficiency levels and price points side by side',
        'Converting from a furnace + AC to a heat pump or dual-fuel system, or adding ductless zones',
        'You want to present rebates, federal tax credits, and financing in one clear document the family can review at the kitchen table',
    ],
    'length'   => '5–8 pages',

    'fields' => [
        'firm_name'      => 'Your company name',
        'contact_name'   => 'Your name',
        'contact_title'  => 'Your title',
        'firm_phone'     => 'Phone',
        'firm_email'     => 'Email',
        'firm_address'   => 'Office address',
        'firm_website'   => 'Website',
        'license_number' => 'License number(s)',
        'client_name'    => 'Client / owner name',
        'project_location' => 'Project address or location',
        'proposal_date'  => 'Proposal date',
        'proposal_valid_days' => 'Days this proposal is valid (e.g., 30)',
    ],

    'checklist' => [
        'Photos of the existing equipment, data plates, ductwork, and any safety concerns (cracked heat exchanger, CO readings, rust) are attached',
        'Manual J load calculation was completed for this home — equipment is not sized by rule of thumb or by matching the old unit',
        'Each option lists an AHRI certificate number or reference confirming the matched system ratings',
        'SEER2 / EER2 / HSPF2 / AFUE figures come from AHRI or manufacturer data, not marketing copy',
        'Every option clearly states what is and is not included — permits, line set, pad, thermostat, disposal, electrical',
        'Rebate and tax-credit amounts are marked as estimates and eligibility was checked against current program rules',
        'The customer is reminded to consult a tax professional regarding federal tax credits',
        'Financing payment examples show term, APR, and that approval is subject to credit',
        'Manufacturer registration deadline for extended warranty is stated (often 60–90 days from install)',
        'Duct condition and static pressure findings are addressed — a new system on restrictive ducts will underperform',
        'Refrigerant type is noted (A2L R-454B or R-32 for new equipment) and line set reuse vs. replacement is explained',
        'Permit and inspection requirements for the jurisdiction are confirmed and included in price',
        'Proposal expiration date and deposit amount are stated',
        'License number appears on the proposal as required by your state',
        'Any required notice of cancellation / right-to-cancel language for in-home sales is attached',
    ],

    'sections' => [
        [
            'heading' => 'Cover Letter',
            'tip'     => 'Open by restating what the homeowner told you matters — comfort in the upstairs bedrooms, high utility bills, a noisy unit, allergies — in their words. Homeowners often receive three proposals; the one that proves the salesperson listened usually wins. Keep it under 200 words and personal.',
            'body'    => <<<'HTML'
<p>{{proposal_date}}</p>
<p>{{client_name}}<br>
{{project_location}}</p>
<p>Dear {{client_name}},</p>
<p>Thank you for inviting {{firm_name}} into your home on [date of visit]. You told us your top priorities are [keeping the upstairs bedrooms comfortable in summer], [lowering your energy bills], and [getting a system you won't have to worry about for the next 15 years]. This proposal is built around those goals.</p>
<p>Inside you'll find what we found during our inspection, the heating and cooling load we calculated for your home, three system options with honest pros and cons, and everything that's included in the installation. We've also noted rebates, tax credits, and financing you may qualify for.</p>
<p>There's no pressure to decide today. If you have questions — or want us to adjust an option — call me directly at {{firm_phone}}.</p>
<p>Sincerely,</p>
<p>{{contact_name}}<br>
{{contact_title}}, {{firm_name}}<br>
{{firm_phone}} | {{firm_email}}<br>
License {{license_number}}</p>
HTML,
        ],
        [
            'heading' => 'What We Found',
            'tip'     => 'This section builds trust more than any other — show, don\'t sell. Attach photos with short captions and record measured readings (static pressure, temperature split, CO, amp draw). Separate safety issues from efficiency issues from age, and never overstate a finding; a homeowner who gets a second opinion should hear the same thing.',
            'body'    => <<<'HTML'
<h4>Existing System</h4>
<table>
<thead>
<tr><th>Component</th><th>Make / Model</th><th>Age</th><th>Size / Rating</th><th>Condition</th></tr>
</thead>
<tbody>
<tr><td>Outdoor unit (AC / heat pump)</td><td>[Make / Model]</td><td>[#] years</td><td>[3] tons, [13] SEER, [R-22 / R-410A]</td><td>[Condition]</td></tr>
<tr><td>Furnace / air handler</td><td>[Make / Model]</td><td>[#] years</td><td>[80,000] BTU input, [80]% AFUE</td><td>[Condition]</td></tr>
<tr><td>Thermostat</td><td>[Make / Model]</td><td>[#] years</td><td>[Non-programmable / Wi-Fi]</td><td>[Condition]</td></tr>
<tr><td>Ductwork</td><td>[Flex / sheet metal / duct board]</td><td>[#] years</td><td>[Location — attic / crawlspace / basement]</td><td>[Condition]</td></tr>
</tbody>
</table>
<h4>Inspection Findings</h4>
<table>
<thead>
<tr><th>Finding</th><th>Measured / Observed</th><th>Why It Matters</th><th>Photo</th></tr>
</thead>
<tbody>
<tr><td>[Heat exchanger condition]</td><td>[e.g., visible crack at (location); CO reading of (#) ppm in flue]</td><td>[Safety — combustion gases may enter the airstream]</td><td>[#1]</td></tr>
<tr><td>Total external static pressure</td><td>[0.00] in. w.c. (manufacturer max [0.50])</td><td>[Restricted airflow reduces capacity and shortens equipment life]</td><td>[#2]</td></tr>
<tr><td>Temperature split across coil</td><td>[#] °F</td><td>[Below the expected range; indicates low charge or airflow problem]</td><td>[#3]</td></tr>
<tr><td>Refrigerant</td><td>[R-22 — no longer produced; recharge cost is high]</td><td>[Repairs are increasingly expensive]</td><td>[#4]</td></tr>
<tr><td>Duct leakage / insulation</td><td>[Disconnected run at (room); uninsulated returns in attic]</td><td>[Conditioned air lost to attic; comfort issues in (rooms)]</td><td>[#5]</td></tr>
<tr><td>Condensate / drainage</td><td>[Rusted secondary pan, no float switch]</td><td>[Risk of ceiling water damage]</td><td>[#6]</td></tr>
<tr><td>Electrical</td><td>[Undersized / corroded disconnect; breaker size]</td><td>[Must meet code for new equipment]</td><td>[#7]</td></tr>
</tbody>
</table>
<h4>Our Recommendation</h4>
<p>Because your system is [#] years old, uses [R-22 refrigerant], and has [a cracked heat exchanger / a failed compressor / repeated repairs totaling $(amount) in the last (#) years], we recommend replacement rather than repair. [If repair is a reasonable option, say so and give the repair price here: "A repair of (item) would cost approximately $(amount) and may extend the system (#) years."]</p>
HTML,
        ],
        [
            'heading' => 'Load Calculation Summary',
            'tip'     => 'A room-by-room ACCA Manual J calculation is what separates a professional proposal from "same size as the old one." Many older systems are oversized, causing short cycling and humidity problems. Summarize the results simply and attach the full report; if you size smaller than the existing unit, explain why that is better.',
            'body'    => <<<'HTML'
<p>We performed an ACCA Manual J load calculation for your home using [software name], based on measurements taken during our visit. Equipment was then selected using Manual S so capacity matches your home's actual needs, and duct recommendations follow Manual D.</p>
<table>
<thead>
<tr><th>Input / Result</th><th>Your Home</th></tr>
</thead>
<tbody>
<tr><td>Conditioned floor area</td><td>[#] sq ft, [#] stories</td></tr>
<tr><td>Design temperatures (outdoor)</td><td>Summer [#] °F / Winter [#] °F</td></tr>
<tr><td>Indoor design</td><td>Cooling 75 °F / Heating 70 °F</td></tr>
<tr><td>Windows</td><td>[Double-pane low-E / single-pane], [#] sq ft, [orientation notes]</td></tr>
<tr><td>Insulation</td><td>Attic R-[#], walls R-[#]</td></tr>
<tr><td>Air tightness</td><td>[Blower door result (#) ACH50 / estimated (tight / average / loose)]</td></tr>
<tr><td><strong>Calculated cooling load</strong></td><td><strong>[#] BTU/h (approx. [#] tons)</strong></td></tr>
<tr><td><strong>Calculated heating load</strong></td><td><strong>[#] BTU/h</strong></td></tr>
<tr><td>Existing equipment size</td><td>[#] tons cooling / [#] BTU/h heating</td></tr>
<tr><td>Recommended equipment size</td><td>[#] tons cooling / [#] BTU/h heating</td></tr>
</tbody>
</table>
<p>[Explain the result in plain language, e.g., "Your current 4-ton system is larger than your home needs. An oversized unit runs in short bursts, which leaves the house feeling clammy and wears out parts faster. A properly sized 3-ton system will run longer, quieter cycles and remove more humidity."]</p>
<p>[If heat pump: "At your winter design temperature of (#) °F, the recommended heat pump delivers (#) BTU/h, covering (#)% of your heating load. (Backup electric heat of (#) kW / your gas furnace in a dual-fuel configuration) covers the balance on the coldest days."]</p>
HTML,
        ],
        [
            'heading' => 'Your Options: Good / Better / Best',
            'tip'     => 'Three options is the sweet spot; more causes decision paralysis. Make the differences real — efficiency, comfort (single-stage vs. variable-speed), noise, and warranty — not just brand names. Use AHRI-matched ratings for the exact indoor/outdoor combination, and put your recommendation in writing with a reason.',
            'body'    => <<<'HTML'
<p>All three options are properly sized for your home, meet current federal efficiency minimums for our region, and include the complete installation described in the next section.</p>
<table>
<thead>
<tr><th></th><th>Good</th><th>Better (Recommended)</th><th>Best</th></tr>
</thead>
<tbody>
<tr><td><strong>System type</strong></td><td>[AC + gas furnace]</td><td>[Heat pump + gas furnace (dual fuel)]</td><td>[Variable-speed heat pump + variable-speed air handler]</td></tr>
<tr><td><strong>Outdoor unit</strong></td><td>[Brand / model]</td><td>[Brand / model]</td><td>[Brand / model]</td></tr>
<tr><td><strong>Indoor unit</strong></td><td>[Brand / model]</td><td>[Brand / model]</td><td>[Brand / model]</td></tr>
<tr><td><strong>AHRI reference no.</strong></td><td>[#]</td><td>[#]</td><td>[#]</td></tr>
<tr><td><strong>Cooling capacity</strong></td><td>[#] BTU/h</td><td>[#] BTU/h</td><td>[#] BTU/h</td></tr>
<tr><td><strong>SEER2 / EER2</strong></td><td>[14.3] / [#]</td><td>[16] / [#]</td><td>[20+] / [#]</td></tr>
<tr><td><strong>HSPF2 (heat pumps)</strong></td><td>N/A</td><td>[#]</td><td>[#]</td></tr>
<tr><td><strong>Furnace AFUE</strong></td><td>[80% / 96%]</td><td>[96%]</td><td>[N/A — all electric / 97%]</td></tr>
<tr><td><strong>Compressor / blower</strong></td><td>Single-stage / multi-speed</td><td>Two-stage / variable-speed blower</td><td>Variable-speed (inverter) / variable-speed blower</td></tr>
<tr><td><strong>Refrigerant</strong></td><td>[R-454B / R-32]</td><td>[R-454B / R-32]</td><td>[R-454B / R-32]</td></tr>
<tr><td><strong>Comfort & humidity control</strong></td><td>Standard</td><td>Improved — longer, quieter low-stage cycles</td><td>Best — precise temperature, enhanced dehumidification</td></tr>
<tr><td><strong>Sound level (outdoor)</strong></td><td>[#] dB</td><td>[#] dB</td><td>[#] dB</td></tr>
<tr><td><strong>Thermostat</strong></td><td>[Programmable]</td><td>[Wi-Fi smart thermostat]</td><td>[Manufacturer communicating control]</td></tr>
<tr><td><strong>Manufacturer parts warranty</strong></td><td>[10] years (with registration)</td><td>[10] years (with registration)</td><td>[10–12] years (with registration)</td></tr>
<tr><td><strong>Compressor / heat exchanger warranty</strong></td><td>[#] years</td><td>[#] years</td><td>[Lifetime / #] years</td></tr>
<tr><td><strong>{{firm_name}} labor warranty</strong></td><td>[2] years</td><td>[5] years</td><td>[10] years</td></tr>
<tr><td><strong>Estimated annual energy savings vs. current system</strong></td><td>$[amount]</td><td>$[amount]</td><td>$[amount]</td></tr>
<tr><td><strong>Maintenance plan</strong></td><td>[Optional]</td><td>[1 year included]</td><td>[2 years included]</td></tr>
<tr><td><strong>Investment</strong></td><td><strong>$[price]</strong></td><td><strong>$[price]</strong></td><td><strong>$[price]</strong></td></tr>
<tr><td><strong>Estimated rebates & credits</strong></td><td>– $[amount]</td><td>– $[amount]</td><td>– $[amount]</td></tr>
<tr><td><strong>Estimated net cost</strong></td><td><strong>$[amount]</strong></td><td><strong>$[amount]</strong></td><td><strong>$[amount]</strong></td></tr>
<tr><td><strong>Monthly payment example</strong></td><td>$[amount]/mo</td><td>$[amount]/mo</td><td>$[amount]/mo</td></tr>
</tbody>
</table>
<p><em>Energy savings are estimates based on [method — e.g., your past 12 months of utility bills and current rates] and will vary with weather, usage, and utility rates. Rebates and credits are estimates; see the Rebates & Tax Credits section.</em></p>
<h4>Why We Recommend the Better Option</h4>
<p>[Tie the recommendation to what the homeowner said, e.g., "The two-stage system runs on low stage most of the time, which solves the uneven upstairs temperatures you described and removes more humidity in summer. The dual-fuel setup uses the efficient heat pump for most of the winter and switches to gas only on the coldest days — and it qualifies for the (utility) rebate."]</p>
HTML,
        ],
        [
            'heading' => 'What\'s Included in Every Option',
            'tip'     => 'This is where lower-priced competitors cut corners, so spell everything out. Homeowners comparing bids often can\'t tell that one excludes the permit, line set, or pad — itemizing makes your price look like the better value. List exclusions too, so there are no surprises on install day.',
            'body'    => <<<'HTML'
<h4>Installation Includes</h4>
<ul>
<li>Removal and responsible disposal of existing equipment, with EPA-compliant refrigerant recovery</li>
<li>New outdoor unit on a new [composite equipment pad / wall brackets], leveled</li>
<li>New indoor unit ([furnace / air handler]) with new evaporator coil matched per AHRI</li>
<li>[New refrigerant line set, insulated / Existing line set flushed, pressure tested, and reused where size and condition allow]</li>
<li>Nitrogen purge while brazing, pressure test, and deep evacuation to [500] microns before charging</li>
<li>Refrigerant charge verified by manufacturer method (superheat / subcooling)</li>
<li>New [supply and return plenum transitions], sealed with mastic</li>
<li>New condensate drain line, [condensate pump], secondary drain pan and float safety switch where required</li>
<li>[New PVC venting for high-efficiency furnace / chimney liner if required for 80% furnace]</li>
<li>Gas line reconnection with new shutoff valve and sediment trap; leak test</li>
<li>New outdoor electrical disconnect and whip; breaker verified to manufacturer requirements</li>
<li>New [thermostat model], installed and programmed with you</li>
<li>New [1-inch / 4-inch media] filter and filter rack</li>
<li>Mechanical permit and all required inspections</li>
<li>Commissioning: static pressure, temperature split, airflow, combustion analysis (gas), and safety control tests, recorded on a startup sheet left with you</li>
<li>Manufacturer warranty registration completed by {{firm_name}}</li>
<li>Floor protection, clean-up, and walk-through of your new system's operation</li>
</ul>
<h4>Not Included (Unless Listed Above or Added)</h4>
<ul>
<li>Ductwork replacement or modifications beyond the connections listed</li>
<li>Electrical panel upgrades or new circuits [if required, priced separately at $(amount)]</li>
<li>Drywall, paint, or finish carpentry repair</li>
<li>Asbestos testing or abatement if suspect materials are found on existing ducts or flue</li>
<li>Crane service [if required for rooftop or difficult access]</li>
</ul>
HTML,
        ],
        [
            'heading' => 'Optional Upgrades: Ductwork & Indoor Air Quality',
            'tip'     => 'Price add-ons individually so the homeowner can pick and choose without re-quoting the whole system. Tie each upgrade to a finding from the inspection (high static pressure, allergies, dry winter air). Don\'t promise health outcomes — describe what the product does.',
            'body'    => <<<'HTML'
<table>
<thead>
<tr><th>Upgrade</th><th>What It Does</th><th>Related Finding</th><th>Price</th></tr>
</thead>
<tbody>
<tr><td>Return air upgrade / duct modifications</td><td>Adds return capacity to reduce static pressure to within manufacturer limits</td><td>[Static pressure of (#) in. w.c.]</td><td>$[amount]</td></tr>
<tr><td>Duct sealing and insulation</td><td>Seals joints with mastic; insulates [attic returns] to R-[#]</td><td>[Leaky / uninsulated ducts]</td><td>$[amount]</td></tr>
<tr><td>Media air cleaner, MERV [11–13]</td><td>Captures finer particles such as pollen and dust; [#]-month filter life</td><td>[Allergy concerns]</td><td>$[amount]</td></tr>
<tr><td>UV light at coil</td><td>Helps keep the indoor coil free of biological growth</td><td>[Coil growth observed]</td><td>$[amount]</td></tr>
<tr><td>Whole-home humidifier</td><td>Adds moisture in winter for comfort</td><td>[Dry air complaints]</td><td>$[amount]</td></tr>
<tr><td>Whole-home dehumidifier</td><td>Controls summer humidity independently of cooling</td><td>[High indoor humidity (#)%]</td><td>$[amount]</td></tr>
<tr><td>Energy recovery ventilator (ERV)</td><td>Brings in filtered fresh air while recovering energy</td><td>[Tight home / stale air]</td><td>$[amount]</td></tr>
<tr><td>Ductless mini-split for [room]</td><td>Independent heating and cooling for a hard-to-condition space</td><td>[Bonus room too hot]</td><td>$[amount]</td></tr>
<tr><td>Surge protector for outdoor unit</td><td>Protects electronics in variable-speed equipment</td><td>—</td><td>$[amount]</td></tr>
</tbody>
</table>
HTML,
        ],
        [
            'heading' => 'Rebates & Tax Credits',
            'tip'     => 'Programs and amounts change frequently — verify current eligibility (efficiency tier, income limits, pre-approval requirements) before presenting numbers, and label every figure as an estimate. Note who files what: you typically handle utility rebate paperwork; the homeowner claims federal tax credits and should consult a tax professional. Never guarantee a rebate or credit.',
            'body'    => <<<'HTML'
<p>The options above may qualify for the following incentives. Amounts are estimates based on program rules as of {{proposal_date}}; final eligibility is determined by each program.</p>
<table>
<thead>
<tr><th>Program</th><th>Eligible Options</th><th>Estimated Amount</th><th>Who Applies</th><th>Requirements / Deadlines</th></tr>
</thead>
<tbody>
<tr><td>[Utility name] equipment rebate</td><td>[Better, Best]</td><td>$[amount]</td><td>{{firm_name}} submits for you</td><td>[Minimum SEER2 / HSPF2; submit within (#) days of install]</td></tr>
<tr><td>Federal energy efficiency tax credit ([Section 25C, if in effect for the installation year])</td><td>[Options meeting the qualifying efficiency tier]</td><td>[Up to $(amount) — verify current rules]</td><td>Homeowner, on federal tax return</td><td>[Qualifying tier; manufacturer certification statement]</td></tr>
<tr><td>[State / local program]</td><td>[Options]</td><td>$[amount]</td><td>[Who]</td><td>[Income limits / pre-approval]</td></tr>
<tr><td>Manufacturer promotion</td><td>[Options]</td><td>$[amount]</td><td>{{firm_name}}</td><td>[Expires (date)]</td></tr>
</tbody>
</table>
<p>We will provide the AHRI certificate, invoice, and manufacturer documentation you need for each program. For tax credits, please consult your tax professional — {{firm_name}} does not provide tax advice.</p>
HTML,
        ],
        [
            'heading' => 'Financing',
            'tip'     => 'Show a monthly payment next to each option so the family can compare apples to apples, but always disclose that terms are examples, approval is subject to credit, and the lender sets final terms. Follow your lender\'s advertising rules exactly — many require specific disclosure language when you quote a rate or payment.',
            'body'    => <<<'HTML'
<p>We offer financing through [lender name] so you can choose the system that's right for your home without paying the full amount up front.</p>
<table>
<thead>
<tr><th>Plan</th><th>Term</th><th>APR</th><th>Good</th><th>Better</th><th>Best</th></tr>
</thead>
<tbody>
<tr><td>[Promotional — e.g., same-as-cash]</td><td>[#] months</td><td>[0% if paid in full within term]</td><td>$[amount]/mo</td><td>$[amount]/mo</td><td>$[amount]/mo</td></tr>
<tr><td>[Fixed-rate installment]</td><td>[#] months</td><td>[#]%</td><td>$[amount]/mo</td><td>$[amount]/mo</td><td>$[amount]/mo</td></tr>
<tr><td>[Long-term low payment]</td><td>[#] months</td><td>[#]%</td><td>$[amount]/mo</td><td>$[amount]/mo</td><td>$[amount]/mo</td></tr>
</tbody>
</table>
<p><em>Payment examples are for illustration only. Financing is provided by [lender], subject to credit approval. [Insert lender-required disclosure language.]</em> You can apply [online at (lender link provided separately) / with {{contact_name}}] in about [10] minutes, with a decision typically [the same day].</p>
<p>Prefer to pay directly? We accept [check, ACH, and major credit cards]. [Cash / check discount of (#)% if offered.]</p>
HTML,
        ],
        [
            'heading' => 'Warranty',
            'tip'     => 'Explain the difference between the manufacturer\'s parts warranty and your labor warranty — homeowners often assume "10-year warranty" covers labor. State registration requirements and deadlines clearly. Only promise what your company can actually honor if you are still servicing the equipment in year ten.',
            'body'    => <<<'HTML'
<h4>Manufacturer Warranty</h4>
<p>Your new equipment carries the manufacturer's limited warranty on parts as listed in the options table. Most manufacturers require registration within [60–90] days of installation to receive the full parts warranty term; {{firm_name}} will register your equipment and send you the confirmation. Manufacturer warranties typically require annual professional maintenance — keep your service records.</p>
<h4>{{firm_name}} Workmanship Warranty</h4>
<p>We warrant our installation workmanship for the period shown for your option. If a problem results from our installation — a refrigerant leak at a brazed joint, a drain issue, a wiring connection — we will correct it at no cost for labor during that period.</p>
<h4>What Warranties Do Not Cover</h4>
<ul>
<li>Damage from lack of maintenance, including clogged filters or drains</li>
<li>Damage from power surges, lightning, flooding, or other acts of nature</li>
<li>Service by others that causes or contributes to a failure</li>
<li>Routine maintenance items such as filters</li>
<li>[Existing ductwork or components not installed by {{firm_name}}]</li>
</ul>
<p>Full manufacturer warranty certificates will be provided with your closing documents.</p>
HTML,
        ],
        [
            'heading' => 'Maintenance Plan',
            'tip'     => 'A maintenance agreement protects the warranty, keeps efficiency up, and builds a long-term customer relationship. Present it as part of the investment, not an afterthought, and list the visit tasks plainly. Including the first year free on higher tiers is a common way to boost acceptance of the recommended option.',
            'body'    => <<<'HTML'
<p>Our [plan name] maintenance agreement keeps your new system running at rated efficiency and helps you meet manufacturer warranty maintenance requirements.</p>
<table>
<thead>
<tr><th>Plan Feature</th><th>Details</th></tr>
</thead>
<tbody>
<tr><td>Visits per year</td><td>[2] — cooling tune-up in spring, heating tune-up in fall</td></tr>
<tr><td>Cooling visit</td><td>Clean outdoor coil, check refrigerant performance, test capacitors and contactor, clear condensate drain, check airflow and temperature split, inspect electrical</td></tr>
<tr><td>Heating visit</td><td>Inspect burners and heat exchanger, combustion analysis, test safeties and ignition, check gas pressure, [heat pump defrost test]</td></tr>
<tr><td>Both visits</td><td>Check/replace standard filter, thermostat calibration, written report of findings</td></tr>
<tr><td>Member benefits</td><td>Priority scheduling, [#]% off repairs, [no overtime charges / waived diagnostic fee]</td></tr>
<tr><td>Price</td><td>$[amount] per year or $[amount] per month</td></tr>
<tr><td>Included with your option</td><td>Good: optional — Better: [1] year included — Best: [2] years included</td></tr>
</tbody>
</table>
HTML,
        ],
        [
            'heading' => 'Project Timeline & What to Expect',
            'tip'     => 'Most residential changeouts take one day; heat pump conversions, duct modifications, or ductless additions may take two to three. Tell the homeowner exactly what they need to do (clear access, pets, parking) and how long they will be without heat or cooling — and offer temporary heat or cooling if the timing requires it.',
            'body'    => <<<'HTML'
<table>
<thead>
<tr><th>Step</th><th>Timing</th><th>What Happens</th></tr>
</thead>
<tbody>
<tr><td>1. Acceptance & deposit</td><td>Day 0</td><td>You sign below; we order equipment and apply for the permit</td></tr>
<tr><td>2. Equipment & permit</td><td>[#]–[#] business days</td><td>Equipment arrives at our warehouse; permit issued by [jurisdiction]</td></tr>
<tr><td>3. Installation</td><td>[1–2] days, starting at [8:00 a.m.]</td><td>Crew of [#] removes old equipment and installs the new system; your home will be without [heating / cooling] for approximately [#] hours</td></tr>
<tr><td>4. Commissioning & walk-through</td><td>End of install day</td><td>We start up and test the system, then show you the thermostat, filter, and what to watch for</td></tr>
<tr><td>5. Inspection</td><td>Within [#] days</td><td>City/county inspector visits; we schedule and attend</td></tr>
<tr><td>6. Follow-up</td><td>[30] days after install</td><td>Courtesy call or visit to confirm everything is working well; rebate paperwork submitted</td></tr>
</tbody>
</table>
<h4>How to Prepare</h4>
<ul>
<li>Clear a path to the [attic / basement / closet] and the outdoor unit location</li>
<li>Secure pets away from work areas</li>
<li>Provide access to the electrical panel and a parking spot near the entrance</li>
<li>[If replacing in extreme weather: we can provide temporary portable heat / cooling at no charge during installation]</li>
</ul>
HTML,
        ],
        [
            'heading' => 'Why Homeowners Choose Us',
            'tip'     => 'Keep this short and verifiable: license, years in business, technician certifications, and real reviews the homeowner can look up. Swap generic claims ("quality service") for specifics ("NATE-certified installers, not subcontractors"). A named local reference in their neighborhood is often more persuasive than any badge.',
            'body'    => <<<'HTML'
<ul>
<li><strong>Licensed and insured:</strong> License {{license_number}}; general liability and workers' compensation coverage</li>
<li><strong>Experience:</strong> Serving [service area] for [Number] years; [Number] system installations in the last [year / 5 years]</li>
<li><strong>Our installers:</strong> [Company employees, not subcontractors]; [EPA 608 certified / NATE-certified / manufacturer-trained on (brand)]</li>
<li><strong>Dealer status:</strong> [Manufacturer dealer program name, if applicable]</li>
<li><strong>Reviews:</strong> [Rating] stars from [Number] reviews on [platform]</li>
<li><strong>Local references:</strong> [Neighborhood / nearby street — homeowner name with permission]</li>
</ul>
<p>"[Short customer review quote, used with permission]" — [Customer first name, city]</p>
HTML,
        ],
        [
            'heading' => 'Terms Summary',
            'tip'     => 'Keep terms short, readable, and consistent with your full contract and state requirements, including any consumer right-to-cancel notice for sales made in the home. State the deposit, when the balance is due, and the proposal expiration so equipment price increases don\'t become disputes.',
            'body'    => <<<'HTML'
<ul>
<li><strong>Proposal valid for:</strong> {{proposal_valid_days}} days from {{proposal_date}}. Equipment pricing after that date is subject to manufacturer price changes.</li>
<li><strong>Deposit:</strong> [#]% ($[amount]) at acceptance to order equipment; balance due upon completion of installation [and walk-through].</li>
<li><strong>Changes:</strong> Any change to the selected scope will be documented in a written change order, signed by you, before the work is performed.</li>
<li><strong>Hidden conditions:</strong> If we discover conditions that could not reasonably be seen during our inspection (for example, suspect asbestos or damaged gas piping in walls), we will stop, explain the issue, and provide a written price before proceeding.</li>
<li><strong>Permits:</strong> {{firm_name}} obtains all required permits and schedules inspections.</li>
<li><strong>Licensing & insurance:</strong> {{firm_name}} is licensed ({{license_number}}) and carries general liability and workers' compensation insurance; certificates available on request.</li>
<li><strong>Right to cancel:</strong> [Insert state-required cancellation notice, if applicable.]</li>
<li><strong>Full terms:</strong> The complete terms and conditions [attached / on the reverse] are part of this agreement.</li>
</ul>
HTML,
        ],
        [
            'heading' => 'Acceptance',
            'tip'     => 'Make it easy to say yes: checkboxes for each option and add-on, a total line, and a signature block. If you use e-signature, keep the same layout. Confirm the selected option and total out loud before the homeowner signs.',
            'body'    => <<<'HTML'
<p>By signing below, I authorize {{firm_name}} to perform the work described in this proposal for the option selected, at {{project_location}}, under the terms stated.</p>
<table>
<thead>
<tr><th>Select</th><th>Item</th><th>Price</th></tr>
</thead>
<tbody>
<tr><td>☐</td><td>Good — [system description]</td><td>$[price]</td></tr>
<tr><td>☐</td><td>Better — [system description]</td><td>$[price]</td></tr>
<tr><td>☐</td><td>Best — [system description]</td><td>$[price]</td></tr>
<tr><td>☐</td><td>Optional upgrade: [item]</td><td>$[price]</td></tr>
<tr><td>☐</td><td>Optional upgrade: [item]</td><td>$[price]</td></tr>
<tr><td>☐</td><td>Maintenance plan (if not included)</td><td>$[price]/yr</td></tr>
<tr><td></td><td><strong>Total</strong></td><td><strong>$__________</strong></td></tr>
<tr><td></td><td>Deposit due at signing</td><td>$__________</td></tr>
</tbody>
</table>
<p>Payment method: ☐ Financing ([lender]) ☐ Check ☐ Card ☐ ACH</p>
<p><strong>Customer</strong><br>
Name: {{client_name}}<br>
Signature: ______________________________ Date: ______________</p>
<p><strong>{{firm_name}}</strong><br>
{{contact_name}}, {{contact_title}}<br>
Signature: ______________________________ Date: ______________</p>
<p>{{firm_name}} | {{firm_address}} | {{firm_phone}} | {{firm_website}} | License {{license_number}}</p>
HTML,
        ],
    ],
];
