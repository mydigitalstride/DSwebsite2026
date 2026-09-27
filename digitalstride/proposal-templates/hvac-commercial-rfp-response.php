<?php
if (!defined('ABSPATH')) exit;

return [
    'slug'     => 'hvac-commercial-rfp-response',
    'title'    => 'Commercial HVAC Maintenance & Service RFP Response',
    'industry' => 'hvac',
    'type'     => 'rfp',
    'summary'  => 'A complete response to a commercial RFP for HVAC preventive maintenance, repair service, and optional equipment replacement — with equipment inventory, PM task frequency, response-time SLA, pricing form, labor rates, and compliance matrix.',
    'use_when' => [
        'A property manager, facilities director, or school district has issued an RFP or bid invitation for an HVAC preventive maintenance (PM) and service contract',
        'The scope covers multiple buildings or a portfolio of RTUs, split systems, VRF, boilers, chillers, and controls',
        'The owner wants fixed annual PM pricing plus hourly labor rates, parts markup, and emergency response commitments',
        'You are proposing an optional equipment replacement or capital plan alongside the maintenance contract',
    ],
    'length'   => '18–35 pages plus attachments',

    'fields' => [
        'firm_name'           => 'Your company name',
        'contact_name'        => 'Your name',
        'contact_title'       => 'Your title',
        'firm_phone'          => 'Phone',
        'firm_email'          => 'Email',
        'firm_address'        => 'Office address',
        'license_number'      => 'License number(s)',
        'client_name'         => 'Client / owner name',
        'client_contact'      => 'Client contact person',
        'project_name'        => 'Project name',
        'project_location'    => 'Project address or location',
        'solicitation_number' => 'RFP / RFQ / bid number',
        'submittal_date'      => 'Submittal date',
        'contract_term'       => 'Contract term (e.g., 3 years + two 1-year renewals)',
        'emergency_phone'     => '24/7 emergency service line',
    ],

    'checklist' => [
        'Every requirement in the RFP is mapped in the compliance matrix, with the page number where it is answered',
        'Section numbering, tab order, and page limits mirror the solicitation exactly; required forms are in the order requested',
        'All addenda are acknowledged by number and date on the bid form',
        'Equipment inventory was verified at the pre-bid walk or site survey — counts, tonnage, and ages match what you priced',
        'PM task frequencies align with the manufacturer, ASHRAE/ACCA Standard 180, and any frequencies the RFP specifies',
        'Filter sizes, MERV ratings, and change frequencies are listed and included in the fixed PM price',
        'Response-time commitments (emergency, urgent, routine) match or beat the RFP and are achievable from your nearest branch',
        'Pricing form is completed on the owner\'s form exactly as issued — no altered line items, blank cells, or unrequested alternates',
        'Labor rates are broken out by classification (journeyman, apprentice, controls tech) for regular, overtime, and holiday hours',
        'Prevailing wage / certified payroll requirements confirmed if the owner is a public entity',
        'Parts markup, refrigerant pricing (per lb by type), and trip/truck charges are stated clearly — no hidden fees',
        'Certificate of insurance meets required limits with the owner named as additional insured; W-9 included',
        'State mechanical contractor license and EPA Section 608 technician certifications attached',
        'Three to five commercial references with current contact names and phone numbers, confirmed before submittal',
        'Exceptions and clarifications are listed in one place — none buried in narrative sections',
        'Proposal signed by an authorized officer; notarization or bid bond included if required',
        'Correct number of hard copies and electronic copy delivered before the deadline to the exact address or portal specified',
    ],

    'sections' => [
        [
            'heading' => 'Transmittal Letter',
            'tip'     => 'Keep it to one page and signed by someone authorized to bind the company. Reference the solicitation number, acknowledge every addendum, and state how long your pricing is valid (90 days is common). Evaluators often check this letter first for responsiveness — a missing addendum acknowledgment can disqualify an otherwise strong bid.',
            'body'    => <<<'HTML'
<p>{{submittal_date}}</p>
<p>{{client_contact}}<br>
{{client_name}}<br>
[Owner mailing address from the RFP]</p>
<p><strong>Re: {{solicitation_number}} — {{project_name}}</strong></p>
<p>Dear {{client_contact}},</p>
<p>{{firm_name}} is pleased to submit this proposal to provide HVAC preventive maintenance, repair service, and [optional equipment replacement] for {{client_name}} at {{project_location}}. We have reviewed the RFP in its entirety, attended the [pre-bid meeting / site walk] on [date], and acknowledge receipt of Addendum No. [1] dated [date] and Addendum No. [2] dated [date].</p>
<p>For [Number] years we have maintained commercial HVAC systems for [property managers / school districts / healthcare / office portfolios] across [service area]. Our proposal is built around three commitments:</p>
<ul>
<li><strong>Fewer emergencies</strong> — a documented PM program based on manufacturer requirements and ASHRAE/ACCA Standard 180, tracked in our CMMS so you can see every task completed.</li>
<li><strong>Fast, predictable response</strong> — 24/7 live dispatch at {{emergency_phone}} with a [Number]-hour on-site commitment for emergencies.</li>
<li><strong>Transparent cost</strong> — a fixed annual PM price, published labor rates, and a stated parts markup, with written approval required before any non-emergency repair over $[amount].</li>
</ul>
<p>Our pricing is valid for [90] days from the submittal date. {{firm_name}} holds license {{license_number}} and meets all insurance requirements stated in the RFP. I am authorized to bind the company and will serve as your primary contact for this solicitation.</p>
<p>Respectfully submitted,</p>
<p>{{contact_name}}<br>
{{contact_title}}, {{firm_name}}<br>
{{firm_phone}} | {{firm_email}}<br>
{{firm_address}}</p>
HTML,
        ],
        [
            'heading' => 'Executive Summary',
            'tip'     => 'Evaluators are often facilities staff and procurement officers reading a stack of near-identical bids. Summarize what makes your program different in plain terms — branch distance, dedicated technician, CMMS reporting, controls capability — and tie each point to a problem the RFP described (aging equipment, comfort complaints, budget pressure). One page maximum.',
            'body'    => <<<'HTML'
<p>{{client_name}} is seeking a qualified mechanical contractor to maintain [Number] HVAC units across [Number] buildings at {{project_location}} under a {{contract_term}} agreement. Based on the RFP and our site survey, we understand your priorities to be [reducing emergency calls and after-hours costs], [extending the life of aging rooftop units], and [improving comfort and indoor air quality for occupants].</p>
<p>{{firm_name}} proposes a comprehensive maintenance and service program that includes:</p>
<ul>
<li>[Quarterly] preventive maintenance on all listed equipment with seasonal heating and cooling startups</li>
<li>All filters, belts, and PM consumables included in the fixed annual price</li>
<li>A dedicated lead technician, [Name], assigned to your portfolio for continuity</li>
<li>24/7/365 emergency response from our [City] branch, [Number] miles from the site</li>
<li>Monthly service reports and an annual equipment condition assessment with a prioritized capital replacement plan</li>
<li>Optional equipment replacement pricing for [Number] units identified as at or beyond expected service life</li>
</ul>
<p>Our total proposed annual PM price is <strong>$[amount]</strong>, with labor rates and markups as shown in the Pricing Form. We are prepared to begin service on [start date] following contract award.</p>
HTML,
        ],
        [
            'heading' => 'Compliance Matrix',
            'tip'     => 'Build this directly from the RFP — every "shall," "must," and submittal requirement gets a row, in the RFP\'s own numbering. Evaluators use it as a scoring checklist, so the page references must be accurate. Mark any deviation honestly as "Exception" and point to the Exceptions section rather than hiding it.',
            'body'    => <<<'HTML'
<p>The following matrix cross-references each requirement in {{solicitation_number}} to the location of our response. "Comply" indicates full compliance without exception.</p>
<table>
<thead>
<tr><th>RFP Section</th><th>Requirement</th><th>Response Location</th><th>Comply / Exception</th></tr>
</thead>
<tbody>
<tr><td>[3.1]</td><td>Transmittal letter signed by authorized officer</td><td>Section 1, p. [#]</td><td>Comply</td></tr>
<tr><td>[3.2]</td><td>Firm qualifications and years in commercial HVAC service</td><td>Section 4, p. [#]</td><td>Comply</td></tr>
<tr><td>[3.3]</td><td>State mechanical license and EPA 608 certifications</td><td>Section 4 and Attachment [A]</td><td>Comply</td></tr>
<tr><td>[3.4]</td><td>Key personnel and resumes</td><td>Section 5, p. [#]</td><td>Comply</td></tr>
<tr><td>[4.1]</td><td>PM on all equipment listed in Exhibit [A]</td><td>Sections 6–7</td><td>Comply</td></tr>
<tr><td>[4.2]</td><td>Filter replacement at [quarterly] intervals, MERV [8/13]</td><td>Section 8, p. [#]</td><td>Comply</td></tr>
<tr><td>[4.3]</td><td>Emergency response within [4] hours, 24/7</td><td>Section 9, p. [#]</td><td>Comply</td></tr>
<tr><td>[4.4]</td><td>Monthly written service reports</td><td>Section 10, p. [#]</td><td>Comply</td></tr>
<tr><td>[4.5]</td><td>Optional equipment replacement pricing</td><td>Section 11 and Pricing Form</td><td>Comply</td></tr>
<tr><td>[5.1]</td><td>Safety program, EMR, and OSHA logs</td><td>Section 12, p. [#]</td><td>Comply</td></tr>
<tr><td>[5.2]</td><td>Three commercial references</td><td>Section 13, p. [#]</td><td>Comply</td></tr>
<tr><td>[6.1]</td><td>Pricing form (Exhibit [B]) completed</td><td>Section 14</td><td>Comply</td></tr>
<tr><td>[6.2]</td><td>Labor rates and parts markup</td><td>Section 15</td><td>Comply</td></tr>
<tr><td>[7.1]</td><td>Certificate of insurance at required limits</td><td>Section 16 and Attachment [C]</td><td>Comply</td></tr>
<tr><td>[7.2]</td><td>Prevailing wage / certified payroll</td><td>Section 16</td><td>[Comply / N/A]</td></tr>
<tr><td>[#]</td><td>[Requirement text copied from RFP]</td><td>[Section, page]</td><td>[Comply / Exception — see Section 16]</td></tr>
</tbody>
</table>
HTML,
        ],
        [
            'heading' => 'Firm Qualifications & Licensing',
            'tip'     => 'Facilities evaluators want proof you already maintain buildings like theirs — similar equipment types, similar occupancy (schools, offices, medical), similar portfolio size. Lead with commercial service volume and technician count, not residential installs. Attach license copies and certifications rather than just listing numbers.',
            'body'    => <<<'HTML'
<h4>Company Overview</h4>
<p>{{firm_name}} has provided commercial HVAC installation, maintenance, and service since [year]. From our [City] location at {{firm_address}}, we currently maintain approximately [Number] commercial buildings and [Number] pieces of HVAC equipment under active service agreements, including [K–12 schools / office buildings / retail centers / medical offices / municipal facilities].</p>
<table>
<thead>
<tr><th>Item</th><th>Detail</th></tr>
</thead>
<tbody>
<tr><td>Legal name / entity type</td><td>{{firm_name}}, [LLC / Corporation]</td></tr>
<tr><td>Years in business</td><td>[Number] years</td></tr>
<tr><td>State mechanical contractor license</td><td>{{license_number}} — [classification], expires [date]</td></tr>
<tr><td>Commercial service technicians on staff</td><td>[Number] ([Number] journeyman, [Number] apprentice, [Number] controls)</td></tr>
<tr><td>EPA Section 608 certified technicians</td><td>[Number] (Universal: [Number])</td></tr>
<tr><td>Industry certifications</td><td>[NATE / manufacturer factory training — list brands] </td></tr>
<tr><td>Service vehicles</td><td>[Number], stocked with [common parts inventory]</td></tr>
<tr><td>Nearest branch to site</td><td>[Address] — [Number] miles / [Number] minutes drive</td></tr>
<tr><td>Union / open shop</td><td>[Local number or open shop]</td></tr>
<tr><td>Small / minority / veteran business certification</td><td>[Certifying agency and number, or N/A]</td></tr>
</tbody>
</table>
<h4>Equipment Experience</h4>
<p>Our technicians routinely service the equipment types in your inventory, including:</p>
<ul>
<li>Packaged rooftop units (RTUs) from [manufacturers], [Number]–[Number] tons, including economizers and gas heat</li>
<li>Split systems, heat pumps, and ductless mini-splits</li>
<li>Variable refrigerant flow (VRF) systems — factory trained on [manufacturer]</li>
<li>Hot water and steam boilers, [air-cooled / water-cooled] chillers, cooling towers, and pumps</li>
<li>Make-up air units, exhaust fans, and energy recovery ventilators (ERVs)</li>
<li>Building automation systems (BAS) — [Niagara / manufacturer platforms]</li>
</ul>
<h4>Refrigerant Transition Readiness</h4>
<p>Our technicians are trained in the handling of A2L refrigerants (R-454B and R-32) used in new equipment under the federal HFC phase-down, and we maintain recovery equipment and recordkeeping for R-410A, R-22, and other legacy refrigerants in compliance with EPA Section 608.</p>
HTML,
        ],
        [
            'heading' => 'Key Personnel & Staffing Plan',
            'tip'     => 'Name real people. Owners buying a maintenance contract are buying the technician who shows up — a named lead tech with years on similar equipment scores far better than a generic "qualified staff" statement. Include a one-paragraph resume for each and note backup coverage for vacations and peak season.',
            'body'    => <<<'HTML'
<p>{{firm_name}} will assign a dedicated team to {{client_name}} so the same people learn your buildings, equipment, and occupants.</p>
<table>
<thead>
<tr><th>Role</th><th>Name</th><th>Years Experience</th><th>Certifications</th><th>Responsibility</th></tr>
</thead>
<tbody>
<tr><td>Account / Service Manager</td><td>[Name]</td><td>[#]</td><td>[Certifications]</td><td>Contract administration, scheduling, reporting, invoicing, escalation</td></tr>
<tr><td>Lead Service Technician</td><td>[Name]</td><td>[#]</td><td>[EPA 608 Universal, NATE, manufacturer]</td><td>Performs and oversees PM, primary responder for service calls</td></tr>
<tr><td>Backup Technician</td><td>[Name]</td><td>[#]</td><td>[Certifications]</td><td>Coverage for PM visits and after-hours calls</td></tr>
<tr><td>Controls Technician</td><td>[Name]</td><td>[#]</td><td>[BAS platform certifications]</td><td>BAS troubleshooting, scheduling, sequence optimization</td></tr>
<tr><td>Project Manager (replacements)</td><td>[Name]</td><td>[#]</td><td>[Certifications]</td><td>Equipment replacement projects, crane lifts, permits, closeout</td></tr>
</tbody>
</table>
<h4>Resume Summaries</h4>
<p><strong>[Name], Lead Service Technician.</strong> [Name] has [Number] years of commercial HVAC service experience and currently maintains [Number] buildings for [type of clients]. [He/She/They] hold[s] [certifications] and [specialty, e.g., factory training on Carrier and Trane RTUs, boiler service].</p>
<p><strong>[Name], Account Manager.</strong> [Name] manages [Number] commercial service agreements totaling [Number] units and will be your single point of contact for scheduling, reports, quotes, and invoicing.</p>
<h4>Coverage & Continuity</h4>
<p>If the lead technician is unavailable, [backup name] — who will accompany the lead on the first [two] PM visits — covers the account. Background checks [and drug screening] are completed for all technicians assigned to [school / secured] sites, and we will comply with {{client_name}}'s badge, sign-in, and key control procedures.</p>
HTML,
        ],
        [
            'heading' => 'Equipment Inventory',
            'tip'     => 'Never price from the RFP\'s equipment list alone — verify counts, tonnage, and age at the site walk and note discrepancies here. An accurate inventory with your added observations (condition, refrigerant, filter sizes) shows diligence and protects you from scope creep. If the owner\'s list is incomplete, state the assumption and price unlisted equipment separately.',
            'body'    => <<<'HTML'
<p>The following inventory is based on Exhibit [A] of the RFP and verified during our site survey on [date]. Discrepancies from the RFP list are noted in the Remarks column. Our PM price covers the equipment below; equipment added after award will be priced at the per-unit rates in the Pricing Form.</p>
<table>
<thead>
<tr><th>Tag / ID</th><th>Building / Location</th><th>Equipment Type</th><th>Make / Model</th><th>Capacity</th><th>Refrigerant / Fuel</th><th>Year Installed</th><th>Filters (Qty — Size — MERV)</th><th>Condition</th><th>Remarks</th></tr>
</thead>
<tbody>
<tr><td>RTU-1</td><td>[Bldg A — roof]</td><td>Packaged RTU, gas/electric</td><td>[Make / Model]</td><td>[10] tons / [180] MBH</td><td>R-410A / Nat. gas</td><td>[Year]</td><td>[4] — [20x25x2] — MERV [8]</td><td>[Good / Fair / Poor]</td><td>[Economizer inoperable]</td></tr>
<tr><td>RTU-2</td><td>[Bldg A — roof]</td><td>Packaged heat pump</td><td>[Make / Model]</td><td>[5] tons</td><td>R-410A</td><td>[Year]</td><td>[2] — [16x25x2] — MERV [8]</td><td>[Condition]</td><td>[Remarks]</td></tr>
<tr><td>AHU-1</td><td>[Bldg B — mech room]</td><td>Air handler w/ HW coil</td><td>[Make / Model]</td><td>[8,000] CFM</td><td>Hot water</td><td>[Year]</td><td>[Qty] — [Size] — MERV [13]</td><td>[Condition]</td><td>[Remarks]</td></tr>
<tr><td>B-1</td><td>[Bldg B — boiler room]</td><td>Hot water boiler</td><td>[Make / Model]</td><td>[1,000] MBH</td><td>Nat. gas</td><td>[Year]</td><td>N/A</td><td>[Condition]</td><td>[Remarks]</td></tr>
<tr><td>CH-1</td><td>[Bldg B — grade]</td><td>Air-cooled chiller</td><td>[Make / Model]</td><td>[80] tons</td><td>[R-410A / R-134a]</td><td>[Year]</td><td>N/A</td><td>[Condition]</td><td>[Remarks]</td></tr>
<tr><td>VRF-1</td><td>[Bldg C]</td><td>VRF condensing unit + [#] indoor units</td><td>[Make / Model]</td><td>[12] tons</td><td>R-410A</td><td>[Year]</td><td>[Qty] washable</td><td>[Condition]</td><td>[Remarks]</td></tr>
<tr><td>SS-1</td><td>[IT room]</td><td>Ductless split (data room)</td><td>[Make / Model]</td><td>[2] tons</td><td>[Refrigerant]</td><td>[Year]</td><td>Washable</td><td>[Condition]</td><td>[Critical — 24/7 cooling]</td></tr>
<tr><td>EF-1–[#]</td><td>[Various]</td><td>Exhaust fans</td><td>[Make]</td><td>[CFM]</td><td>N/A</td><td>[Year]</td><td>N/A</td><td>[Condition]</td><td>[Remarks]</td></tr>
</tbody>
</table>
<h4>Inventory Summary</h4>
<ul>
<li>Total units included in PM: [Number]</li>
<li>Total cooling capacity: approximately [Number] tons</li>
<li>Units at or beyond typical expected service life ([15–20] years for RTUs): [Number]</li>
<li>Units using R-22 or other phased-out refrigerants: [Number] — see Section 11</li>
<li>Equipment found on site but not listed in the RFP: [List, or "None"]</li>
</ul>
HTML,
        ],
        [
            'heading' => 'Preventive Maintenance Program & Task Frequency',
            'tip'     => 'This is the heart of the technical score. Show task-level detail by equipment type and frequency, and reference ASHRAE/ACCA Standard 180 and manufacturer requirements so evaluators know the program is standards-based. If the RFP specifies frequencies, match them exactly; if you recommend more or fewer visits, explain why and price it as an alternate.',
            'body'    => <<<'HTML'
<p>Our PM program follows manufacturer recommendations and ANSI/ASHRAE/ACCA Standard 180, <em>Standard Practice for Inspection and Maintenance of Commercial Building HVAC Systems</em>. Each task is loaded into our CMMS as a checklist tied to the equipment tag, so every visit is documented with technician, date, readings, and deficiencies found.</p>
<h4>Visit Schedule</h4>
<table>
<thead>
<tr><th>Visit</th><th>Timing</th><th>Focus</th></tr>
</thead>
<tbody>
<tr><td>Spring (Cooling Startup)</td><td>[March–April]</td><td>Full cooling inspection, coil cleaning, refrigerant circuit check, economizer operation</td></tr>
<tr><td>Summer</td><td>[June–July]</td><td>Filter change, belt check, operational check under peak load</td></tr>
<tr><td>Fall (Heating Startup)</td><td>[September–October]</td><td>Full heating inspection, combustion analysis, heat exchanger inspection, safeties</td></tr>
<tr><td>Winter</td><td>[December–January]</td><td>Filter change, heating operation check, freeze protection</td></tr>
</tbody>
</table>
<h4>Task Frequency by Equipment Type</h4>
<p>M = Monthly, Q = Quarterly, S = Semi-annual (spring/fall), A = Annual.</p>
<table>
<thead>
<tr><th>Equipment</th><th>Task</th><th>Frequency</th></tr>
</thead>
<tbody>
<tr><td>RTUs / Split Systems</td><td>Replace filters; inspect filter racks and seals</td><td>Q</td></tr>
<tr><td>RTUs / Split Systems</td><td>Inspect and adjust belts; replace as needed (belts included)</td><td>Q</td></tr>
<tr><td>RTUs / Split Systems</td><td>Lubricate motors and bearings where applicable</td><td>S</td></tr>
<tr><td>RTUs / Split Systems</td><td>Clean condenser coils; inspect evaporator coil; clear and treat condensate drain and pan</td><td>S</td></tr>
<tr><td>RTUs / Split Systems</td><td>Check refrigerant operating pressures, superheat/subcooling; leak check</td><td>S</td></tr>
<tr><td>RTUs / Split Systems</td><td>Measure compressor and fan motor amps and voltage; inspect contactors and wiring</td><td>S</td></tr>
<tr><td>RTUs / Split Systems</td><td>Test economizer: damper operation, actuator, sensors, minimum outside air setting</td><td>S</td></tr>
<tr><td>RTUs (gas heat)</td><td>Inspect heat exchanger, burners, ignition, flame sensor; combustion analysis (CO, O2, efficiency)</td><td>A (fall)</td></tr>
<tr><td>RTUs (gas heat)</td><td>Test high-limit, rollout, and pressure switches and all safeties</td><td>A (fall)</td></tr>
<tr><td>Air Handlers</td><td>Filters, belts, bearings, coil inspection, damper and actuator operation, drain pan</td><td>Q</td></tr>
<tr><td>VRF Systems</td><td>Clean indoor unit filters; review system error history; check outdoor coil and refrigerant data via service tool</td><td>Q</td></tr>
<tr><td>Boilers</td><td>Inspect burner, ignition, flue, and controls; combustion analysis; test low-water cutoff and relief valve operation</td><td>A (fall) + [monthly visual during heating season]</td></tr>
<tr><td>Chillers</td><td>Log operating data; inspect for leaks; check oil level and electrical connections</td><td>M (cooling season)</td></tr>
<tr><td>Chillers</td><td>Clean condenser coils; oil analysis [and eddy current testing if water-cooled, priced separately]</td><td>A</td></tr>
<tr><td>Cooling Towers</td><td>Inspect fill, basin, drift eliminators, fan, gearbox; coordinate with water treatment vendor</td><td>M (cooling season)</td></tr>
<tr><td>Pumps</td><td>Inspect seals, couplings, bearings; record pressures and amps</td><td>Q</td></tr>
<tr><td>Exhaust Fans / ERVs</td><td>Belts, bearings, wheel/core cleaning, damper operation</td><td>S</td></tr>
<tr><td>Thermostats / BAS</td><td>Verify setpoints, schedules, sensor calibration; review alarms and trends</td><td>Q</td></tr>
</tbody>
</table>
<h4>Deficiencies Found During PM</h4>
<p>Minor corrective items (tightening connections, resetting controls, replacing fuses and belts) are corrected during the visit at no additional charge. Repairs beyond the PM scope are documented with photos and a written quote; no repair over $[amount] proceeds without {{client_contact}}'s written approval except in an emergency affecting life safety, property, or critical operations.</p>
HTML,
        ],
        [
            'heading' => 'Filter & Consumables Schedule',
            'tip'     => 'Filters are the most-audited line of a PM contract. List each size, MERV rating, quantity, and change frequency, and state that they are included in the fixed price. Many owners now specify MERV 13 for indoor air quality — confirm the equipment can handle the added static pressure before committing.',
            'body'    => <<<'HTML'
<p>The following filters and consumables are included in the fixed annual PM price. Filters will be dated on the frame at each change.</p>
<table>
<thead>
<tr><th>Filter Size</th><th>Type / MERV</th><th>Qty per Change</th><th>Changes per Year</th><th>Annual Qty</th><th>Equipment Served</th></tr>
</thead>
<tbody>
<tr><td>[20x25x2]</td><td>Pleated MERV [8]</td><td>[#]</td><td>[4]</td><td>[#]</td><td>[RTU-1, RTU-3]</td></tr>
<tr><td>[24x24x4]</td><td>Pleated MERV [13]</td><td>[#]</td><td>[4]</td><td>[#]</td><td>[AHU-1]</td></tr>
<tr><td>[Size]</td><td>[Bag / Final] MERV [14]</td><td>[#]</td><td>[1]</td><td>[#]</td><td>[AHU-2]</td></tr>
<tr><td>[Size]</td><td>[Type]</td><td>[#]</td><td>[#]</td><td>[#]</td><td>[Units]</td></tr>
</tbody>
</table>
<h4>Other Included Consumables</h4>
<ul>
<li>V-belts for all belt-driven equipment</li>
<li>Condensate pan tablets / drain treatment</li>
<li>Coil cleaner (non-acid, environmentally safe)</li>
<li>Lubricants</li>
<li>[Other — e.g., humidifier pads at annual interval]</li>
</ul>
<p><strong>Not included:</strong> refrigerant, motors, compressors, controls components, and other repair parts, which are billed per the Labor Rates & Markups section.</p>
HTML,
        ],
        [
            'heading' => 'Service Response & Service Level Agreement (SLA)',
            'tip'     => 'Define the priority levels precisely (what counts as an emergency) and state both response time and on-site time. Only promise what your branch location and staffing can meet in rush hour and peak season — missed SLAs are the fastest route to contract termination. If you can offer remote BAS diagnosis within minutes, say so.',
            'body'    => <<<'HTML'
<p>{{firm_name}} provides live 24/7/365 dispatch at <strong>{{emergency_phone}}</strong>. Calls are answered by [our own dispatchers / a live answering service] and routed to the on-call technician immediately. Service requests may also be submitted by [email / client portal / work order system integration].</p>
<table>
<thead>
<tr><th>Priority</th><th>Definition</th><th>Phone Response</th><th>On-Site Arrival</th><th>Status Update</th></tr>
</thead>
<tbody>
<tr><td>P1 — Emergency</td><td>Complete loss of heating or cooling to occupied space; life safety concern; gas odor; water leak damaging property; critical space (data room, [medical, freezer]) down</td><td>[15] minutes</td><td>[2–4] hours, 24/7</td><td>Every [2] hours until resolved</td></tr>
<tr><td>P2 — Urgent</td><td>Partial loss of capacity; single unit down with others serving the space; comfort complaint affecting multiple occupants</td><td>[30] minutes</td><td>[Same / next] business day</td><td>Daily</td></tr>
<tr><td>P3 — Routine</td><td>Non-urgent repairs, noise, single-zone comfort issue, quote requests</td><td>[4] business hours</td><td>Within [3–5] business days</td><td>At scheduling</td></tr>
<tr><td>P4 — Scheduled</td><td>PM visits, planned repairs, projects</td><td>N/A</td><td>Per agreed schedule</td><td>[7] days advance notice</td></tr>
</tbody>
</table>
<h4>Service Hours</h4>
<ul>
<li>Regular hours: [Monday–Friday, 7:00 a.m.–4:30 p.m.]</li>
<li>After hours: weekdays outside regular hours and Saturdays</li>
<li>Premium / holiday: Sundays and [list observed holidays]</li>
</ul>
<h4>Performance Measurement</h4>
<p>We track dispatch time, arrival time, and resolution time for every call and report SLA performance monthly. If we miss the P1 arrival commitment [more than (Number) times in a quarter], we will [credit the trip charge / meet with {{client_contact}} to present a corrective action plan]. [If the RFP includes liquidated damages or performance credits, confirm acceptance or note an exception here.]</p>
<h4>Parts Availability</h4>
<p>Our service vehicles carry common motors, capacitors, contactors, igniters, and belts. We maintain accounts with [distributors] in [City] for same-day pickup of most parts; for critical equipment we recommend stocking [spare parts list] on site.</p>
HTML,
        ],
        [
            'heading' => 'Reporting, CMMS & Controls Support',
            'tip'     => 'Facilities managers have to justify contracts to their boards and CFOs — give them reports they can forward. Describe exactly what they receive and when (a sample report as an attachment scores well). If the RFP requires use of the owner\'s work order system, confirm you will enter tickets there.',
            'body'    => <<<'HTML'
<p>Every PM visit and service call is logged in [CMMS/software name], giving {{client_name}} a complete, searchable history for each piece of equipment.</p>
<h4>What You Receive</h4>
<table>
<thead>
<tr><th>Report</th><th>Frequency</th><th>Contents</th></tr>
</thead>
<tbody>
<tr><td>Visit report</td><td>Each visit (emailed within [24] hours)</td><td>Tasks completed, readings, photos, deficiencies, recommendations</td></tr>
<tr><td>Service ticket</td><td>Each call</td><td>Problem, cause, corrective action, parts, labor hours, technician signature</td></tr>
<tr><td>Monthly summary</td><td>Monthly</td><td>PM completion %, open deficiencies, service calls by priority, SLA performance, spend to date</td></tr>
<tr><td>Annual condition assessment</td><td>Annually</td><td>Condition rating per unit, remaining useful life estimate, 5-year capital replacement forecast</td></tr>
<tr><td>Refrigerant log</td><td>As required</td><td>Refrigerant added/recovered by unit and type, leak rate calculations for systems subject to EPA 608 leak repair requirements</td></tr>
</tbody>
</table>
<h4>Owner Work Order System</h4>
<p>We will [accept and close work orders in {{client_name}}'s system — e.g., (platform name)] and reference the owner work order number on every invoice.</p>
<h4>Building Automation / Controls</h4>
<p>With [remote / on-site] access to your BAS, our controls technician can review alarms, verify schedules, and often diagnose issues before a truck rolls. During PM we verify occupancy schedules, setpoints, and economizer sequences — adjustments that frequently reduce energy use without capital cost. Controls programming beyond minor schedule and setpoint changes is billed at the controls technician rate.</p>
HTML,
        ],
        [
            'heading' => 'Optional Equipment Replacement',
            'tip'     => 'Keep replacement pricing separate from PM pricing so it does not inflate your evaluated maintenance cost. Base recommendations on the condition assessment — age, refrigerant, repair history — and note that replacements include permits, crane, curb adapters, and startup. Mention utility rebates for high-efficiency equipment as a placeholder; never quote rebate amounts you haven\'t confirmed.',
            'body'    => <<<'HTML'
<p>Based on our site survey, the following units are at or beyond expected service life, use phased-out refrigerant, or have a repair history that makes replacement more cost-effective than continued repair. Pricing is provided as an option on the Pricing Form and is not included in the PM price.</p>
<table>
<thead>
<tr><th>Tag</th><th>Existing Unit (Age / Refrigerant)</th><th>Reason for Recommendation</th><th>Proposed Replacement</th><th>Efficiency (IEER / SEER2 / Thermal Eff.)</th><th>Priority</th><th>Price</th></tr>
</thead>
<tbody>
<tr><td>[RTU-4]</td><td>[22 yrs / R-22]</td><td>[Compressor failure risk, R-22 unavailable]</td><td>[Tons] RTU, [A2L refrigerant], [economizer]</td><td>[IEER]</td><td>[Year 1]</td><td>$[amount]</td></tr>
<tr><td>[RTU-6]</td><td>[18 yrs / R-410A]</td><td>[Heat exchanger corrosion]</td><td>[Description]</td><td>[Rating]</td><td>[Year 2]</td><td>$[amount]</td></tr>
<tr><td>[B-1]</td><td>[Age / fuel]</td><td>[Reason]</td><td>[Condensing boiler, (MBH)]</td><td>[% thermal efficiency]</td><td>[Year 3]</td><td>$[amount]</td></tr>
</tbody>
</table>
<h4>Replacement Pricing Includes</h4>
<ul>
<li>Equipment as specified, AHRI-rated, with manufacturer warranty of [Number] years parts / [Number] years compressor</li>
<li>Mechanical permit and inspections; [structural review of roof loading if required]</li>
<li>Crane and rigging, including [street closure / permit] where needed</li>
<li>Curb adapter or new curb, [roofing contractor tie-in by owner's roofer to preserve roof warranty]</li>
<li>Disconnect and removal of existing equipment; EPA-compliant refrigerant recovery</li>
<li>Electrical and gas reconnection to existing services within [10] feet</li>
<li>Thermostat or BAS integration, startup, and test and balance of the new unit</li>
<li>[Number]-year labor warranty from {{firm_name}}</li>
</ul>
<p>Work in occupied buildings will be scheduled [after hours / on weekends / during school breaks] to minimize disruption. Replacements may qualify for [utility name] commercial rebates of $[amount per ton or unit]; we will prepare the rebate application on {{client_name}}'s behalf where eligible.</p>
HTML,
        ],
        [
            'heading' => 'Safety Program',
            'tip'     => 'Public and institutional owners often score safety as a pass/fail gate. Provide your EMR (below 1.0 is the benchmark) and three years of OSHA 300A data, and describe rooftop fall protection, lockout/tagout, and work practices around occupants. Attach your written safety program if requested.',
            'body'    => <<<'HTML'
<p>{{firm_name}} maintains a written safety program reviewed annually and applied to every job site.</p>
<table>
<thead>
<tr><th>Metric</th><th>[Year]</th><th>[Year]</th><th>[Year]</th></tr>
</thead>
<tbody>
<tr><td>Experience Modification Rate (EMR)</td><td>[0.00]</td><td>[0.00]</td><td>[0.00]</td></tr>
<tr><td>OSHA Total Recordable Incident Rate (TRIR)</td><td>[0.00]</td><td>[0.00]</td><td>[0.00]</td></tr>
<tr><td>DART Rate</td><td>[0.00]</td><td>[0.00]</td><td>[0.00]</td></tr>
<tr><td>Fatalities</td><td>[0]</td><td>[0]</td><td>[0]</td></tr>
<tr><td>OSHA citations</td><td>[None / describe]</td><td>[ ]</td><td>[ ]</td></tr>
</tbody>
</table>
<h4>Key Program Elements</h4>
<ul>
<li>OSHA 10-hour training for all field staff; OSHA 30-hour for supervisors</li>
<li>Fall protection for rooftop work, including leading-edge and skylight protection</li>
<li>Lockout/tagout on all equipment before service</li>
<li>Arc-flash awareness and appropriate PPE when working on energized circuits</li>
<li>Confined space procedures for mechanical vaults and pits where applicable</li>
<li>Refrigerant handling per EPA Section 608; A2L refrigerant handling training</li>
<li>Weekly toolbox talks and documented site hazard assessments</li>
</ul>
<h4>Working in Occupied Facilities</h4>
<p>Technicians check in and out with [site contact / front office], wear company uniforms and photo ID, keep work areas cordoned, and never leave tools, ladders, or open panels unattended in occupied areas. For school sites, all personnel complete [district-required background check] before starting work.</p>
HTML,
        ],
        [
            'heading' => 'References & Similar Contracts',
            'tip'     => 'Choose references with similar building types and portfolio size, and call each one before you submit so they expect the call. Evaluators do call — an unreachable or lukewarm reference can cost more points than a missing one. Include contract value and duration to show you can handle the scale.',
            'body'    => <<<'HTML'
<p>The following clients have agreed to discuss our performance with {{client_name}}.</p>
<table>
<thead>
<tr><th>Client / Facility</th><th>Scope</th><th>Units / Buildings</th><th>Annual Value</th><th>Contract Period</th><th>Contact</th></tr>
</thead>
<tbody>
<tr><td>[Client name — facility type]</td><td>[PM + service + replacements]</td><td>[#] units / [#] bldgs</td><td>$[amount]</td><td>[Year]–present</td><td>[Name, title — phone — email]</td></tr>
<tr><td>[Client name — facility type]</td><td>[Scope]</td><td>[#] / [#]</td><td>$[amount]</td><td>[Years]</td><td>[Name, title — phone — email]</td></tr>
<tr><td>[Client name — facility type]</td><td>[Scope]</td><td>[#] / [#]</td><td>$[amount]</td><td>[Years]</td><td>[Name, title — phone — email]</td></tr>
</tbody>
</table>
<h4>Relevant Contract Highlight</h4>
<p><strong>[Client name — Contract name].</strong> Since [year] we have maintained [Number] RTUs and [other equipment] across [Number] [schools / buildings]. In the first year of our program, [describe a verifiable outcome, e.g., reduced emergency calls from X to Y, completed replacement of Z units during summer break]. [Only include figures the client can confirm.]</p>
HTML,
        ],
        [
            'heading' => 'Pricing Form',
            'tip'     => 'If the RFP includes a pricing form, use it exactly as issued — altered or retyped forms are a common cause of rejection — and use this section only as a mirror or supplement. Make sure unit counts match the inventory, and price every year of the term including escalation if requested. Blank cells should read "Included" or "N/A," never empty.',
            'body'    => <<<'HTML'
<p>The pricing below corresponds to Exhibit [B] of {{solicitation_number}}. All prices include labor, travel, filters, belts, and PM consumables as described in this proposal. [Prices include / exclude] applicable sales tax.</p>
<h4>A. Annual Preventive Maintenance (Fixed Price)</h4>
<table>
<thead>
<tr><th>Building / Site</th><th>Units</th><th>Visits per Year</th><th>Year 1</th><th>Year 2</th><th>Year 3</th></tr>
</thead>
<tbody>
<tr><td>[Building A]</td><td>[#]</td><td>[4]</td><td>$[amount]</td><td>$[amount]</td><td>$[amount]</td></tr>
<tr><td>[Building B]</td><td>[#]</td><td>[4]</td><td>$[amount]</td><td>$[amount]</td><td>$[amount]</td></tr>
<tr><td>[Building C]</td><td>[#]</td><td>[4]</td><td>$[amount]</td><td>$[amount]</td><td>$[amount]</td></tr>
<tr><td><strong>Total Annual PM</strong></td><td>[#]</td><td></td><td><strong>$[amount]</strong></td><td><strong>$[amount]</strong></td><td><strong>$[amount]</strong></td></tr>
</tbody>
</table>
<p>Renewal years: annual escalation not to exceed [3]% or [CPI index], whichever is [less].</p>
<h4>B. Per-Unit Rates for Added or Removed Equipment</h4>
<table>
<thead>
<tr><th>Equipment Type</th><th>Annual PM Price per Unit</th></tr>
</thead>
<tbody>
<tr><td>RTU / split system up to 5 tons</td><td>$[amount]</td></tr>
<tr><td>RTU 6–15 tons</td><td>$[amount]</td></tr>
<tr><td>RTU 16–30 tons</td><td>$[amount]</td></tr>
<tr><td>Ductless / VRF indoor unit</td><td>$[amount]</td></tr>
<tr><td>Boiler (per unit)</td><td>$[amount]</td></tr>
<tr><td>Exhaust fan</td><td>$[amount]</td></tr>
</tbody>
</table>
<h4>C. Optional Services</h4>
<table>
<thead>
<tr><th>Item</th><th>Unit</th><th>Price</th></tr>
</thead>
<tbody>
<tr><td>Additional filter change (all units, one cycle)</td><td>Per cycle</td><td>$[amount]</td></tr>
<tr><td>Upgrade all filters to MERV 13</td><td>Annual add</td><td>$[amount]</td></tr>
<tr><td>Coil chemical cleaning (evaporator)</td><td>Per unit</td><td>$[amount]</td></tr>
<tr><td>Duct cleaning</td><td>[Per system / per LF]</td><td>$[amount]</td></tr>
<tr><td>Annual chiller oil analysis</td><td>Per chiller</td><td>$[amount]</td></tr>
<tr><td>Equipment replacement — see Section 11</td><td>Per unit</td><td>See schedule</td></tr>
</tbody>
</table>
<h4>D. Total Evaluated Price</h4>
<p>[If the RFP defines a formula for evaluated price — e.g., annual PM plus an assumed number of service hours at the stated rates — show the calculation here exactly as the RFP describes it.]</p>
HTML,
        ],
        [
            'heading' => 'Labor Rates, Markups & Billing',
            'tip'     => 'Owners compare labor rates line by line, so break them out by classification and time of day and state what counts as overtime. Disclose trip charges, minimum billing increments, and refrigerant prices per pound — surprises on the first invoice poison the relationship. For public work, confirm rates comply with the applicable prevailing wage determination.',
            'body'    => <<<'HTML'
<h4>Hourly Labor Rates</h4>
<table>
<thead>
<tr><th>Classification</th><th>Regular</th><th>After Hours / Saturday</th><th>Sunday / Holiday</th></tr>
</thead>
<tbody>
<tr><td>Journeyman Service Technician</td><td>$[rate]</td><td>$[rate]</td><td>$[rate]</td></tr>
<tr><td>Apprentice / Helper</td><td>$[rate]</td><td>$[rate]</td><td>$[rate]</td></tr>
<tr><td>Controls / BAS Technician</td><td>$[rate]</td><td>$[rate]</td><td>$[rate]</td></tr>
<tr><td>Refrigeration / Chiller Technician</td><td>$[rate]</td><td>$[rate]</td><td>$[rate]</td></tr>
<tr><td>Project Manager</td><td>$[rate]</td><td>$[rate]</td><td>$[rate]</td></tr>
</tbody>
</table>
<h4>Other Charges</h4>
<table>
<thead>
<tr><th>Item</th><th>Rate / Terms</th></tr>
</thead>
<tbody>
<tr><td>Trip / truck charge</td><td>[$amount per call / None — included in hourly rate]</td></tr>
<tr><td>Minimum billing</td><td>[1] hour regular; [2] hours after hours; billed in [15]-minute increments thereafter</td></tr>
<tr><td>Parts and materials markup</td><td>Cost plus [Number]% (supplier invoices available on request)</td></tr>
<tr><td>Subcontracted services markup</td><td>Cost plus [Number]%</td></tr>
<tr><td>Refrigerant R-410A</td><td>$[amount] per lb</td></tr>
<tr><td>Refrigerant R-454B / R-32</td><td>$[amount] per lb</td></tr>
<tr><td>Refrigerant R-22 (reclaimed, subject to availability)</td><td>$[amount] per lb</td></tr>
<tr><td>Crane / lift rental</td><td>Cost plus [Number]%</td></tr>
<tr><td>Discount on repairs for contract customers</td><td>[Number]% off standard labor rates</td></tr>
</tbody>
</table>
<h4>Billing & Payment</h4>
<ul>
<li>PM billed [quarterly in arrears / monthly in equal installments]</li>
<li>Service calls invoiced within [5] business days with signed ticket and owner work order number attached</li>
<li>Payment terms: net [30] days, or per {{client_name}}'s standard terms</li>
<li>Prevailing wage: [Rates shown comply with the applicable prevailing wage determination; certified payroll will be submitted (weekly/monthly) / Not applicable]</li>
</ul>
HTML,
        ],
        [
            'heading' => 'Insurance, Required Forms & Exceptions',
            'tip'     => 'Put every required form here in the order the RFP lists them, and consolidate all exceptions and clarifications in one list. Common exceptions in HVAC PM contracts involve unlimited indemnity, consequential damages, liquidated damages, and liability for pre-existing conditions — state them plainly and propose alternate language. Having no exceptions is best, but an honest, reasonable exception is better than defaulting later.',
            'body'    => <<<'HTML'
<h4>Insurance</h4>
<p>{{firm_name}} carries the following coverage and will name {{client_name}} [and its property manager] as additional insured on a primary and non-contributory basis, with waiver of subrogation, as required by the RFP.</p>
<table>
<thead>
<tr><th>Coverage</th><th>Required by RFP</th><th>Our Limits</th><th>Carrier</th></tr>
</thead>
<tbody>
<tr><td>Commercial General Liability</td><td>$[amount] per occurrence / $[amount] aggregate</td><td>$[amount] / $[amount]</td><td>[Carrier]</td></tr>
<tr><td>Automobile Liability</td><td>$[amount] combined single limit</td><td>$[amount]</td><td>[Carrier]</td></tr>
<tr><td>Workers' Compensation</td><td>Statutory</td><td>Statutory</td><td>[Carrier]</td></tr>
<tr><td>Employer's Liability</td><td>$[amount]</td><td>$[amount]</td><td>[Carrier]</td></tr>
<tr><td>Umbrella / Excess</td><td>$[amount]</td><td>$[amount]</td><td>[Carrier]</td></tr>
<tr><td>Pollution Liability (if required)</td><td>$[amount]</td><td>$[amount]</td><td>[Carrier]</td></tr>
</tbody>
</table>
<h4>Required Forms & Attachments</h4>
<ol>
<li>Signed Bid / Proposal Form — Attachment [A]</li>
<li>Addenda acknowledgment</li>
<li>Certificate of insurance (sample with required endorsements)</li>
<li>W-9</li>
<li>State mechanical contractor license — {{license_number}}</li>
<li>EPA Section 608 certification cards for assigned technicians</li>
<li>[Non-collusion affidavit / debarment certification / conflict of interest disclosure]</li>
<li>[Prevailing wage acknowledgment / E-Verify affidavit / Iran divestment or other state-specific forms]</li>
<li>[Bid bond, if required — (Number)% of annual contract value]</li>
<li>Sample PM visit report and annual condition assessment</li>
</ol>
<h4>Exceptions & Clarifications</h4>
<ol>
<li>[If none: "{{firm_name}} takes no exception to the terms and conditions of {{solicitation_number}}."]</li>
<li>[Clarification: PM pricing assumes equipment is in operable condition at contract start. Deficiencies identified during the initial inspection will be reported and quoted separately.]</li>
<li>[Clarification: Repairs to equipment not accessible by fixed ladder or roof hatch may require lift rental, billed per the Labor Rates section.]</li>
<li>[Exception: Section (#) — describe the term and proposed alternate language.]</li>
</ol>
<p>Submitted by {{contact_name}}, {{contact_title}}, on behalf of {{firm_name}}, {{submittal_date}}.</p>
<p>Signature: ______________________________ Date: ______________</p>
HTML,
        ],
    ],
];
