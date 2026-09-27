<?php
if (!defined('ABSPATH')) exit;

return [
    'slug'     => 'plumbing-commercial-rfp-response',
    'title'    => 'Commercial Plumbing Service & Maintenance RFP Response',
    'industry' => 'plumbing',
    'type'     => 'rfp',
    'summary'  => 'A complete response to a multi-site commercial plumbing RFP — backflow testing program, grease interceptor and drain maintenance, preventive maintenance, emergency response, and repairs — with site inventory, SLA table, pricing form, labor rates, and compliance matrix.',
    'use_when' => [
        'A property manager, facilities department, school district, or municipality has issued an RFP or bid for plumbing service and maintenance across multiple sites',
        'The scope includes annual backflow testing and certification, grease trap / interceptor pumping, drain line jetting, and on-call repairs',
        'The owner wants unit pricing for recurring services plus hourly rates, markup, and guaranteed emergency response times',
        'You are bidding a renewal and need to document your program more formally than the last contract',
    ],
    'length'   => '18–30 pages plus attachments',

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
        'Every "shall" and submittal requirement in the RFP appears in the compliance matrix with an accurate page reference',
        'Response follows the solicitation\'s section numbering, tab order, and page limits exactly',
        'All addenda acknowledged by number and date on the bid form',
        'Site list, backflow assembly counts (by type and size), and interceptor sizes verified against the RFP exhibits and site walk',
        'Backflow tester certifications are current for every tester named, with test gauge calibration dates, and you are registered with each water purveyor where required',
        'Grease interceptor pumping frequency matches the local FOG ordinance or the 25% rule, and manifest / disposal documentation is described',
        'Pricing form completed exactly as issued — unit prices per assembly and per interceptor, no blank cells or altered quantities',
        'Labor rates broken out by classification and time of day (regular, after hours, holiday), with trip charge and minimum billing stated',
        'Prevailing wage and certified payroll requirements confirmed for public-entity work',
        'Emergency response commitments are achievable from your nearest branch to the farthest site at peak traffic',
        'Jetter, camera, and vacuum truck equipment listed — owned vs. subcontracted is stated honestly',
        'Medical gas (ASSE 6010) or other specialty certifications included only if the scope requires and you hold them',
        'Certificate of insurance at required limits with owner as additional insured; pollution liability included if interceptor or hazardous waste work is in scope',
        'State plumbing contractor license and master plumber license attached',
        'Three to five commercial references with current contact information, called in advance',
        'Exceptions and clarifications consolidated in one section',
        'Signed by an authorized officer; bid bond or notarization included if required; delivered on time to the correct portal or address',
    ],

    'sections' => [
        [
            'heading' => 'Transmittal Letter',
            'tip'     => 'One page, signed by an officer who can bind the company. Reference the solicitation number, acknowledge every addendum by number and date, and state your pricing validity period. Procurement staff often screen for responsiveness here before the technical evaluators ever see the proposal.',
            'body'    => <<<'HTML'
<p>{{submittal_date}}</p>
<p>{{client_contact}}<br>
{{client_name}}<br>
[Owner mailing address from the RFP]</p>
<p><strong>Re: {{solicitation_number}} — {{project_name}}</strong></p>
<p>Dear {{client_contact}},</p>
<p>{{firm_name}} is pleased to submit our proposal to provide plumbing preventive maintenance, backflow testing and certification, grease interceptor and drain line maintenance, emergency response, and on-call repair services for {{client_name}} at {{project_location}}. We have reviewed the RFP and all exhibits, attended the [pre-proposal meeting / site walk] on [date], and acknowledge Addendum No. [1] dated [date] and Addendum No. [2] dated [date].</p>
<p>We currently provide recurring plumbing service for [Number] commercial sites, including [property management portfolios / schools / restaurants / healthcare facilities / municipal buildings]. Our approach for {{client_name}} centers on:</p>
<ul>
<li><strong>Compliance you can document</strong> — every backflow assembly tested and certified on schedule, with test reports filed with the water purveyor and copies in your records.</li>
<li><strong>Preventing the costly call</strong> — scheduled interceptor pumping and drain jetting that keep grease and debris from becoming a backup, a health department violation, or a sewer surcharge.</li>
<li><strong>Fast emergency response</strong> — 24/7 live dispatch at {{emergency_phone}} and a [Number]-hour on-site commitment for emergencies at every site.</li>
</ul>
<p>Our pricing is valid for [90] days. {{firm_name}} holds license {{license_number}} and meets the insurance requirements of the RFP. I am authorized to bind the company and will serve as your contact for this solicitation.</p>
<p>Respectfully submitted,</p>
<p>{{contact_name}}<br>
{{contact_title}}, {{firm_name}}<br>
{{firm_phone}} | {{firm_email}}<br>
{{firm_address}}</p>
HTML,
        ],
        [
            'heading' => 'Executive Summary',
            'tip'     => 'Connect your program to the owner\'s real pain points — failed backflow compliance notices, recurring kitchen backups, slow vendors, surprise invoices. Evaluators remember a clear one-page summary with the total annual recurring price and the response commitment. Save technical detail for later sections.',
            'body'    => <<<'HTML'
<p>{{client_name}} requires a single qualified plumbing contractor to maintain [Number] sites under a {{contract_term}} agreement. Based on the RFP and our site visits, we understand your priorities to be [maintaining 100% backflow compliance with (water purveyor)], [eliminating grease-related backups at food service locations], and [consolidating vendors with consistent pricing and reporting across the portfolio].</p>
<p>{{firm_name}} proposes:</p>
<ul>
<li>Annual testing and certification of [Number] backflow prevention assemblies, with filing to [water purveyor(s)] and a portfolio-wide compliance tracker</li>
<li>Scheduled pumping of [Number] grease interceptors and [Number] grease traps at frequencies that meet the [City] FOG ordinance</li>
<li>[Annual / semi-annual] hydro-jetting of kitchen and main drain lines with camera verification</li>
<li>[Semi-annual] preventive maintenance on water heaters, booster and sump pumps, mixing valves, and fixtures</li>
<li>24/7/365 emergency response with [Number]-hour on-site arrival</li>
<li>A dedicated account manager and lead technician for continuity and a single point of contact</li>
</ul>
<p>Our total annual recurring service price is <strong>$[amount]</strong>, with repair labor rates and markups as shown in the Pricing Form. We can begin service on [start date].</p>
HTML,
        ],
        [
            'heading' => 'Compliance Matrix',
            'tip'     => 'Create one row for every requirement in the RFP, using the RFP\'s own numbering, and keep page references accurate — evaluators use this as their scoring sheet. Any deviation should be marked "Exception" and explained in the Exceptions section. Update the page numbers last, after final layout.',
            'body'    => <<<'HTML'
<p>The following matrix cross-references each requirement of {{solicitation_number}} to our response.</p>
<table>
<thead>
<tr><th>RFP Section</th><th>Requirement</th><th>Response Location</th><th>Comply / Exception</th></tr>
</thead>
<tbody>
<tr><td>[2.1]</td><td>Transmittal letter signed by authorized representative</td><td>Section 1, p. [#]</td><td>Comply</td></tr>
<tr><td>[2.2]</td><td>Firm experience with multi-site commercial plumbing</td><td>Section 4, p. [#]</td><td>Comply</td></tr>
<tr><td>[2.3]</td><td>Plumbing contractor and master plumber licenses</td><td>Section 4 and Attachment [A]</td><td>Comply</td></tr>
<tr><td>[2.4]</td><td>Certified backflow testers and gauge calibration</td><td>Sections 5 and 7</td><td>Comply</td></tr>
<tr><td>[3.1]</td><td>Annual backflow testing and filing with water purveyor</td><td>Section 7, p. [#]</td><td>Comply</td></tr>
<tr><td>[3.2]</td><td>Grease interceptor pumping per local ordinance, with manifests</td><td>Section 8, p. [#]</td><td>Comply</td></tr>
<tr><td>[3.3]</td><td>Drain line jetting and camera inspection</td><td>Section 8, p. [#]</td><td>Comply</td></tr>
<tr><td>[3.4]</td><td>Preventive maintenance on water heaters and pumps</td><td>Section 9, p. [#]</td><td>Comply</td></tr>
<tr><td>[3.5]</td><td>24/7 emergency response within [2] hours</td><td>Section 10, p. [#]</td><td>Comply</td></tr>
<tr><td>[3.6]</td><td>Written quotes and approval for repairs over $[amount]</td><td>Section 11, p. [#]</td><td>Comply</td></tr>
<tr><td>[4.1]</td><td>Safety program and EMR</td><td>Section 12, p. [#]</td><td>Comply</td></tr>
<tr><td>[4.2]</td><td>Three references for similar contracts</td><td>Section 13, p. [#]</td><td>Comply</td></tr>
<tr><td>[5.1]</td><td>Pricing form (Exhibit [C])</td><td>Section 14</td><td>Comply</td></tr>
<tr><td>[5.2]</td><td>Hourly rates, markup, and trip charges</td><td>Section 15</td><td>Comply</td></tr>
<tr><td>[6.1]</td><td>Insurance certificate at required limits</td><td>Section 16 and Attachment [B]</td><td>Comply</td></tr>
<tr><td>[6.2]</td><td>Prevailing wage / certified payroll</td><td>Section 16</td><td>[Comply / N/A]</td></tr>
<tr><td>[#]</td><td>[Requirement text copied from RFP]</td><td>[Section, page]</td><td>[Comply / Exception — see Section 16]</td></tr>
</tbody>
</table>
HTML,
        ],
        [
            'heading' => 'Firm Qualifications & Licensing',
            'tip'     => 'Lead with commercial service capacity — licensed plumbers on staff, service trucks, jetters, cameras, and whether you own a vacuum truck or subcontract pumping. Owners with multiple sites want proof you can cover all of them at once. Attach licenses and certifications rather than simply listing them.',
            'body'    => <<<'HTML'
<h4>Company Overview</h4>
<p>{{firm_name}} has provided commercial plumbing service since [year] from our facility at {{firm_address}}. We maintain [Number] commercial service accounts covering [Number] sites, with particular experience in [multi-tenant office / retail centers with food service / K–12 schools / multifamily / healthcare / municipal buildings].</p>
<table>
<thead>
<tr><th>Item</th><th>Detail</th></tr>
</thead>
<tbody>
<tr><td>Legal name / entity type</td><td>{{firm_name}}, [LLC / Corporation]</td></tr>
<tr><td>Years in business</td><td>[Number] years</td></tr>
<tr><td>State plumbing contractor license</td><td>{{license_number}} — expires [date]</td></tr>
<tr><td>Master plumber(s) of record</td><td>[Name — license number]</td></tr>
<tr><td>Licensed plumbers on staff</td><td>[Number] master, [Number] journeyman, [Number] apprentices</td></tr>
<tr><td>Certified backflow testers</td><td>[Number] — certified by [ASSE / ABPA / state or purveyor program]</td></tr>
<tr><td>Registered with water purveyors</td><td>[List purveyors serving the sites]</td></tr>
<tr><td>Medical gas certification (if applicable)</td><td>[Number] ASSE 6010 installers / [N/A]</td></tr>
<tr><td>Service vehicles</td><td>[Number] stocked service trucks</td></tr>
<tr><td>Specialty equipment</td><td>[Number] hydro-jetters ([#] trailer-mounted, [#] PSI / [#] GPM), [Number] sewer inspection cameras with locators, [vacuum truck — owned / subcontracted to (name)], leak detection equipment</td></tr>
<tr><td>Branch nearest to sites</td><td>[Address] — [Number] miles to the farthest site</td></tr>
<tr><td>Business certifications</td><td>[MBE / WBE / SBE / veteran-owned — certifying agency and number, or N/A]</td></tr>
</tbody>
</table>
<h4>Code & Standards</h4>
<p>All work is performed to the [International Plumbing Code / Uniform Plumbing Code] as adopted by [jurisdiction], local amendments, water purveyor cross-connection control requirements, and the [City/County] fats, oils, and grease (FOG) ordinance. Permits are obtained for all work that requires them.</p>
HTML,
        ],
        [
            'heading' => 'Key Personnel & Staffing Plan',
            'tip'     => 'Name the account manager, lead technician, and backflow tester, and give each a short resume. For multi-site contracts, show how you will staff simultaneous calls and peak periods — evaluators worry about a vendor that only has one person who knows their buildings.',
            'body'    => <<<'HTML'
<table>
<thead>
<tr><th>Role</th><th>Name</th><th>Years Experience</th><th>Licenses / Certifications</th><th>Responsibility</th></tr>
</thead>
<tbody>
<tr><td>Account Manager</td><td>[Name]</td><td>[#]</td><td>[Licenses]</td><td>Contract administration, scheduling, quotes, reporting, invoicing</td></tr>
<tr><td>Lead Service Plumber</td><td>[Name]</td><td>[#]</td><td>[Journeyman / Master — license #]</td><td>Preventive maintenance, service calls, repair quotes</td></tr>
<tr><td>Backflow Tester</td><td>[Name]</td><td>[#]</td><td>[Certification # — expires (date)]</td><td>Annual testing, repairs, report filing</td></tr>
<tr><td>Drain / Jetting Technician</td><td>[Name]</td><td>[#]</td><td>[Certifications]</td><td>Jetting, camera inspection, interceptor inspections</td></tr>
<tr><td>Backup Service Plumber(s)</td><td>[Name(s)]</td><td>[#]</td><td>[Licenses]</td><td>Coverage for emergencies and simultaneous calls</td></tr>
</tbody>
</table>
<h4>Resume Summaries</h4>
<p><strong>[Name], Lead Service Plumber.</strong> [Name] is a licensed [journeyman / master] plumber with [Number] years of commercial experience, including [domestic water systems, booster pumps, commercial water heaters, and kitchen drainage]. [He/She/They] currently serve[s] [client types].</p>
<p><strong>[Name], Backflow Tester.</strong> Certified since [year], [Name] tests approximately [Number] assemblies per year across [purveyors], and is trained in the repair and rebuild of [RP, DC, PVB, and SVB] assemblies.</p>
<h4>Coverage Across Sites</h4>
<p>With [Number] service plumbers on call each night and weekend, we can respond to [Number] simultaneous emergencies across the portfolio. All personnel assigned to {{client_name}} sites complete [background checks / site safety orientation] and follow site check-in, badge, and key control procedures.</p>
HTML,
        ],
        [
            'heading' => 'Site & Asset Inventory',
            'tip'     => 'Verify every assembly and interceptor at the site walk — size, type, location, and access (vault, ceiling, confined space) all affect price. Owners\' lists are often outdated; noting discrepancies shows diligence and protects your pricing. State that assets added after award will be priced at your unit rates.',
            'body'    => <<<'HTML'
<p>The following inventory is based on Exhibit [A] of the RFP and verified during our site visits on [dates]. Discrepancies are noted in Remarks.</p>
<h4>Sites</h4>
<table>
<thead>
<tr><th>Site #</th><th>Site Name / Address</th><th>Building Type</th><th>Food Service</th><th>Water Purveyor</th><th>Sewer Authority</th><th>Remarks</th></tr>
</thead>
<tbody>
<tr><td>[1]</td><td>[Name — address]</td><td>[Office / retail / school]</td><td>[Yes — (#) kitchens / No]</td><td>[Purveyor]</td><td>[Authority]</td><td>[Remarks]</td></tr>
<tr><td>[2]</td><td>[Name — address]</td><td>[Type]</td><td>[Yes / No]</td><td>[Purveyor]</td><td>[Authority]</td><td>[Remarks]</td></tr>
<tr><td>[3]</td><td>[Name — address]</td><td>[Type]</td><td>[Yes / No]</td><td>[Purveyor]</td><td>[Authority]</td><td>[Remarks]</td></tr>
</tbody>
</table>
<h4>Backflow Prevention Assemblies</h4>
<table>
<thead>
<tr><th>Site #</th><th>Assembly ID / Serial</th><th>Type (RP / DC / DCDA / RPDA / PVB / SVB)</th><th>Size</th><th>Make / Model</th><th>Service (Domestic / Fire / Irrigation / Process)</th><th>Location / Access</th><th>Last Test Date</th></tr>
</thead>
<tbody>
<tr><td>[1]</td><td>[Serial]</td><td>[RP]</td><td>[2"]</td><td>[Make / Model]</td><td>[Domestic]</td><td>[Mech room]</td><td>[Date]</td></tr>
<tr><td>[1]</td><td>[Serial]</td><td>[DCDA]</td><td>[6"]</td><td>[Make / Model]</td><td>[Fire]</td><td>[Riser room / vault]</td><td>[Date]</td></tr>
<tr><td>[2]</td><td>[Serial]</td><td>[PVB]</td><td>[1"]</td><td>[Make / Model]</td><td>[Irrigation]</td><td>[Exterior]</td><td>[Date]</td></tr>
</tbody>
</table>
<h4>Grease Interceptors & Traps</h4>
<table>
<thead>
<tr><th>Site #</th><th>ID</th><th>Type</th><th>Capacity</th><th>Location</th><th>Current Pump Frequency</th><th>Condition / Remarks</th></tr>
</thead>
<tbody>
<tr><td>[1]</td><td>[GI-1]</td><td>[In-ground interceptor]</td><td>[1,000] gal</td><td>[Parking lot]</td><td>[Quarterly]</td><td>[Baffle deteriorated]</td></tr>
<tr><td>[2]</td><td>[GT-1]</td><td>[Under-sink trap]</td><td>[50] GPM / [100] lb</td><td>[Kitchen]</td><td>[Monthly]</td><td>[Remarks]</td></tr>
</tbody>
</table>
<h4>Other Maintained Equipment</h4>
<table>
<thead>
<tr><th>Site #</th><th>Equipment</th><th>Make / Model / Size</th><th>Year</th><th>Condition</th></tr>
</thead>
<tbody>
<tr><td>[1]</td><td>[Commercial gas water heater, (#) gal / (#) MBH]</td><td>[Make / Model]</td><td>[Year]</td><td>[Condition]</td></tr>
<tr><td>[1]</td><td>[Domestic booster pump system]</td><td>[Make / Model]</td><td>[Year]</td><td>[Condition]</td></tr>
<tr><td>[2]</td><td>[Sump / sewage ejector pumps]</td><td>[Make / Model]</td><td>[Year]</td><td>[Condition]</td></tr>
<tr><td>[3]</td><td>[Thermostatic mixing valves / emergency eyewash-shower tempering]</td><td>[Make / Model]</td><td>[Year]</td><td>[Condition]</td></tr>
</tbody>
</table>
HTML,
        ],
        [
            'heading' => 'Backflow Testing & Certification Program',
            'tip'     => 'Backflow compliance is a regulatory obligation for the owner, so evaluators want to see a closed-loop process: schedule, test, repair, retest, file, and report. Name the purveyors you are registered with and how you meet each one\'s filing deadline and format. Price failed-assembly repairs separately from testing.',
            'body'    => <<<'HTML'
<p>{{firm_name}} will test every backflow prevention assembly in the inventory annually [or at the frequency required by each water purveyor] using certified testers and calibrated test kits, following [ASSE / USC Foundation for Cross-Connection Control / state] test procedures.</p>
<h4>Program Steps</h4>
<ol>
<li><strong>Schedule:</strong> Within [30] days of award we build a compliance calendar from each purveyor's due dates and schedule tests at least [30] days before each deadline.</li>
<li><strong>Coordinate shutdowns:</strong> Tests on domestic assemblies require a brief water interruption. We coordinate with {{client_contact}} and site staff to test [before opening / after hours] and post notices [48] hours in advance. Fire line tests are coordinated with [the fire alarm monitoring company] to avoid false alarms.</li>
<li><strong>Test:</strong> Our certified tester records all readings on the purveyor's required form. Test gauges are calibrated [annually] — calibration certificates are attached.</li>
<li><strong>Repair:</strong> If an assembly fails, we notify you the same day with a written repair quote. Common repairs (check rubber, relief valve rebuild) can usually be completed during the same visit with your approval.</li>
<li><strong>Retest and file:</strong> Repaired assemblies are retested and results are filed with the water purveyor [electronically through (system) / by mail] within [#] days, meeting each purveyor's deadline.</li>
<li><strong>Report:</strong> {{client_name}} receives copies of all test reports and a portfolio compliance tracker showing each assembly's status and next due date.</li>
</ol>
<h4>Assemblies Requiring Special Handling</h4>
<ul>
<li>Fire line assemblies (DCDA / RPDA): coordinated with fire protection contractor and alarm monitoring; [we do / do not] hold the required fire sprinkler license for [jurisdiction]</li>
<li>Assemblies in vaults or confined spaces: tested using confined space entry procedures</li>
<li>Assemblies serving critical processes (medical, labs, kitchens): scheduled to avoid service interruption, with [bypass / temporary supply] where available</li>
</ul>
HTML,
        ],
        [
            'heading' => 'Grease Interceptor & Drain Line Maintenance',
            'tip'     => 'Tie pumping frequency to the local FOG ordinance and to measured grease and solids accumulation — many jurisdictions require pumping when FOG plus solids reach 25% of the interceptor\'s depth. Describe manifests and disposal at a permitted facility; owners can be fined for missing records. Camera verification after jetting shows the line is truly clear.',
            'body'    => <<<'HTML'
<h4>Grease Interceptor & Trap Service</h4>
<p>Interceptors and traps will be pumped at the frequencies below, which meet the [City] FOG ordinance and the [25% rule]. At each service we:</p>
<ul>
<li>Measure FOG and solids depth before pumping and record the percentage of capacity</li>
<li>Completely evacuate the interceptor, including the solids layer — not just a skim of the top</li>
<li>Scrape walls and baffles; inspect inlet and outlet tees, baffles, and lids for damage</li>
<li>Inspect for corrosion, cracked lids, or missing sanitary tees, and report deficiencies with photos</li>
<li>Provide a waste manifest documenting volume removed and disposal at [permitted facility name]</li>
<li>Leave a service tag on site and record the service in the FOG log kept for inspectors</li>
</ul>
<table>
<thead>
<tr><th>Site #</th><th>Interceptor / Trap ID</th><th>Capacity</th><th>Proposed Frequency</th><th>Basis</th></tr>
</thead>
<tbody>
<tr><td>[1]</td><td>[GI-1]</td><td>[1,000] gal</td><td>[Every 90 days]</td><td>[Ordinance maximum; adjust based on measured accumulation]</td></tr>
<tr><td>[2]</td><td>[GT-1]</td><td>[50] GPM</td><td>[Monthly]</td><td>[Kitchen volume]</td></tr>
</tbody>
</table>
<p>If measured accumulation consistently runs below [25]%, we will recommend a reduced frequency (subject to ordinance) to lower your cost; if above, we will recommend more frequent service before a backup or violation occurs.</p>
<h4>Drain Line Jetting & Camera Inspection</h4>
<table>
<thead>
<tr><th>Line</th><th>Method</th><th>Frequency</th><th>Deliverable</th></tr>
</thead>
<tbody>
<tr><td>Kitchen drain lines to interceptor</td><td>Hydro-jetting, [#] PSI with appropriate nozzle</td><td>[Semi-annual]</td><td>Before/after camera footage</td></tr>
<tr><td>Main building sewer to property line / city tap</td><td>Hydro-jetting</td><td>[Annual]</td><td>Camera inspection with defect log and locate marks</td></tr>
<tr><td>Storm drains / area drains</td><td>Jetting / vacuum</td><td>[Annual, before (rainy season)]</td><td>Service report</td></tr>
<tr><td>Floor drains / trap primers</td><td>Inspect and fill traps; verify primer operation</td><td>[Quarterly]</td><td>Checklist</td></tr>
</tbody>
</table>
<p>Camera footage is provided to {{client_name}} [by secure download link]. Defects such as root intrusion, offset joints, belly sections, or deteriorated cast iron are rated and reported with a recommended repair method — including [trenchless lining or pipe bursting] where appropriate — and a written quote.</p>
HTML,
        ],
        [
            'heading' => 'Preventive Maintenance Program',
            'tip'     => 'Show a task-by-frequency table for everything in scope — water heaters, pumps, mixing valves, fixtures, and shutoff valves. Exercising isolation valves and flushing water heaters are commonly skipped by competitors and valued by facility managers. Match any frequencies specified in the RFP exactly.',
            'body'    => <<<'HTML'
<p>Our PM program is performed per manufacturer recommendations and documented by site and asset. M = Monthly, Q = Quarterly, S = Semi-annual, A = Annual.</p>
<table>
<thead>
<tr><th>System / Equipment</th><th>Task</th><th>Frequency</th></tr>
</thead>
<tbody>
<tr><td>Commercial water heaters / boilers (domestic)</td><td>Flush sediment; inspect anode rod [every (#) years]; test T&amp;P relief valve; inspect venting and combustion; verify setpoint</td><td>S</td></tr>
<tr><td>Tankless water heaters</td><td>Descale heat exchanger; clean inlet filter; check error codes</td><td>A [or per water hardness]</td></tr>
<tr><td>Thermostatic mixing valves</td><td>Verify outlet temperature within [set range]; clean and service cartridge</td><td>A</td></tr>
<tr><td>Emergency eyewash / shower tempering valves</td><td>Verify tepid water delivery per ANSI Z358.1; coordinate with owner's weekly activation</td><td>A</td></tr>
<tr><td>Recirculation pumps</td><td>Check operation, amp draw, and timer/aquastat settings</td><td>S</td></tr>
<tr><td>Domestic booster pump systems</td><td>Verify pressures, controls, pressure tank precharge, and alternation</td><td>Q</td></tr>
<tr><td>Sump pumps / sewage ejectors</td><td>Test float and alarm; clean basin; check check valve and discharge</td><td>Q</td></tr>
<tr><td>Main and branch isolation valves</td><td>Exercise and tag; report any valve that will not operate</td><td>A</td></tr>
<tr><td>Pressure-reducing valves</td><td>Verify downstream pressure; adjust or report</td><td>A</td></tr>
<tr><td>Restroom fixtures</td><td>Inspect flush valves, faucets, supply stops, and seals; adjust flush volumes; report leaks</td><td>S</td></tr>
<tr><td>Hose bibbs / wall hydrants</td><td>Check vacuum breakers; winterize where required</td><td>A (fall)</td></tr>
<tr><td>Water softeners / treatment (if in scope)</td><td>Check salt, regeneration settings, and hardness</td><td>Q</td></tr>
<tr><td>Trap primers</td><td>Verify operation</td><td>Q</td></tr>
</tbody>
</table>
<p>Minor adjustments (flush valve adjustment, tightening packing nuts, resetting controls) are included. Repairs beyond the PM scope are quoted per Section 11.</p>
HTML,
        ],
        [
            'heading' => 'Emergency Response & Service Level Agreement',
            'tip'     => 'Define exactly what qualifies as an emergency and commit to both phone response and on-site arrival times for every site — including the farthest one. Water damage compounds by the hour, so owners weigh this heavily. Never commit to times you can\'t meet at 2 a.m. on a holiday weekend.',
            'body'    => <<<'HTML'
<p>Live 24/7/365 dispatch: <strong>{{emergency_phone}}</strong>. Calls are answered by [our own dispatch team / a live answering service] and routed immediately to the on-call plumber. Non-emergency requests may be submitted by [email / portal / owner work order system].</p>
<table>
<thead>
<tr><th>Priority</th><th>Definition</th><th>Phone Response</th><th>On-Site Arrival</th><th>Status Updates</th></tr>
</thead>
<tbody>
<tr><td>P1 — Emergency</td><td>Active leak or flooding; sewage backup; no water to building; gas leak; failed water heater at [critical site]; condition closing a food service operation</td><td>[15] minutes</td><td>[1–2] hours, 24/7</td><td>Every [2] hours until stabilized</td></tr>
<tr><td>P2 — Urgent</td><td>Restroom out of service; slow drains affecting operations; loss of hot water at non-critical site</td><td>[30] minutes</td><td>[4] hours / same business day</td><td>Daily</td></tr>
<tr><td>P3 — Routine</td><td>Dripping faucets, running toilets, non-urgent repairs, quote requests</td><td>[4] business hours</td><td>Within [2–3] business days</td><td>At scheduling</td></tr>
<tr><td>P4 — Scheduled</td><td>PM, backflow tests, interceptor pumping, planned projects</td><td>N/A</td><td>Per compliance calendar</td><td>[7] days advance notice</td></tr>
</tbody>
</table>
<h4>Emergency Protocol</h4>
<ol>
<li>Stabilize: stop the water, isolate the fixture or system, and protect property</li>
<li>Communicate: call {{client_contact}} or the designated site contact with an initial assessment</li>
<li>Restore: complete the repair or provide a temporary fix to restore service; quote any permanent repair</li>
<li>Coordinate: recommend water mitigation / restoration vendor if needed [or provide via our partner (name)]</li>
<li>Document: service ticket with photos, cause, and work performed within [24] hours</li>
</ol>
<h4>Service Hours</h4>
<ul>
<li>Regular: [Monday–Friday, 7:00 a.m.–4:30 p.m.]</li>
<li>After hours: weekdays outside regular hours and Saturdays</li>
<li>Holiday / Sunday: [list observed holidays]</li>
</ul>
<p>We report SLA performance monthly. [State acceptance of any performance credits or liquidated damages in the RFP, or note an exception in Section 16.]</p>
HTML,
        ],
        [
            'heading' => 'Repairs, Approvals & Reporting',
            'tip'     => 'Property managers answer to owners, so describe a clean approval workflow with a not-to-exceed threshold and photo documentation. Offer the reports they need to budget — especially a capital planning list of aging water heaters and deteriorated drain lines. A sample report as an attachment scores well.',
            'body'    => <<<'HTML'
<h4>Repair Approval Process</h4>
<ul>
<li>Repairs under $[amount] may be completed during the visit with verbal approval from the site contact, documented on the ticket</li>
<li>Repairs of $[amount] or more require a written quote with photos and approval from {{client_contact}} [or designee] before work proceeds, except in a P1 emergency to prevent property damage</li>
<li>Quotes are delivered within [2] business days and itemize labor hours, materials, permits, and any restoration</li>
<li>Owner purchase order or work order number is referenced on every invoice</li>
</ul>
<h4>Reports</h4>
<table>
<thead>
<tr><th>Report</th><th>Frequency</th><th>Contents</th></tr>
</thead>
<tbody>
<tr><td>Service ticket</td><td>Each call</td><td>Problem, cause, work performed, parts, labor, photos, technician</td></tr>
<tr><td>Backflow compliance tracker</td><td>Monthly and upon each test</td><td>Assembly status, test date, pass/fail, repairs, filing confirmation, next due</td></tr>
<tr><td>FOG log & manifests</td><td>Each pumping</td><td>Accumulation %, volume removed, disposal manifest</td></tr>
<tr><td>Monthly summary</td><td>Monthly</td><td>Calls by site and priority, SLA performance, PM completion, spend to date</td></tr>
<tr><td>Annual condition report</td><td>Annually</td><td>Water heater ages, drain line camera findings, recommended capital repairs with budget estimates</td></tr>
</tbody>
</table>
<p>Reports are delivered by email and [available in our customer portal]. We will [enter and close work orders in {{client_name}}'s work order system] if required.</p>
HTML,
        ],
        [
            'heading' => 'Safety & Environmental Compliance',
            'tip'     => 'Include your EMR and three years of OSHA 300A data, then address plumbing-specific hazards: confined space (vaults, interceptors), trenching, hot work, sewage exposure, and lead-safe practices. Grease and waste disposal documentation belongs here — owners are liable if a hauler dumps illegally.',
            'body'    => <<<'HTML'
<table>
<thead>
<tr><th>Metric</th><th>[Year]</th><th>[Year]</th><th>[Year]</th></tr>
</thead>
<tbody>
<tr><td>Experience Modification Rate (EMR)</td><td>[0.00]</td><td>[0.00]</td><td>[0.00]</td></tr>
<tr><td>OSHA Total Recordable Incident Rate (TRIR)</td><td>[0.00]</td><td>[0.00]</td><td>[0.00]</td></tr>
<tr><td>DART Rate</td><td>[0.00]</td><td>[0.00]</td><td>[0.00]</td></tr>
<tr><td>OSHA citations</td><td>[None / describe]</td><td>[ ]</td><td>[ ]</td></tr>
</tbody>
</table>
<h4>Program Elements</h4>
<ul>
<li>Written safety program; OSHA 10 for all field staff, OSHA 30 for supervisors</li>
<li>Permit-required confined space entry procedures for vaults, pits, and interceptors, with gas monitoring and attendant</li>
<li>Excavation and trenching safety per OSHA Subpart P, with utility locates before any digging</li>
<li>Lockout/tagout for pumps and electrical equipment; hot work permits for brazing and soldering</li>
<li>Bloodborne pathogen and sewage exposure procedures, PPE, and vaccination offered to exposed staff</li>
<li>Lead-safe work practices [EPA RRP certification where required]</li>
<li>Traffic control when working in parking lots or drive lanes</li>
</ul>
<h4>Environmental Compliance</h4>
<ul>
<li>Grease and interceptor waste hauled by [our permitted vacuum truck / licensed hauler (name, permit #)] to [permitted disposal facility]</li>
<li>Manifests retained for [#] years and provided to {{client_name}}</li>
<li>Jetting wastewater contained and disposed of properly — never discharged to storm drains</li>
<li>Water heaters and fixtures recycled where facilities are available</li>
</ul>
HTML,
        ],
        [
            'heading' => 'References & Similar Contracts',
            'tip'     => 'Pick references with similar site counts and scope — especially backflow programs and food service. Call each reference before submitting so they are expecting the evaluator\'s call. Include annual contract value and duration to show you handle this scale.',
            'body'    => <<<'HTML'
<table>
<thead>
<tr><th>Client</th><th>Scope</th><th>Sites / Assemblies / Interceptors</th><th>Annual Value</th><th>Contract Period</th><th>Contact</th></tr>
</thead>
<tbody>
<tr><td>[Client name — facility type]</td><td>[Backflow program + PM + on-call]</td><td>[#] / [#] / [#]</td><td>$[amount]</td><td>[Year]–present</td><td>[Name, title — phone — email]</td></tr>
<tr><td>[Client name — facility type]</td><td>[Scope]</td><td>[#] / [#] / [#]</td><td>$[amount]</td><td>[Years]</td><td>[Name, title — phone — email]</td></tr>
<tr><td>[Client name — facility type]</td><td>[Scope]</td><td>[#] / [#] / [#]</td><td>$[amount]</td><td>[Years]</td><td>[Name, title — phone — email]</td></tr>
</tbody>
</table>
<h4>Contract Highlight</h4>
<p><strong>[Client name — Contract name].</strong> Since [year] we have managed backflow compliance for [Number] assemblies and grease interceptor service at [Number] food service locations for [client]. [Describe a verifiable outcome the client will confirm, e.g., brought all assemblies into compliance within the first (#) days; eliminated repeat kitchen backups at (site) after instituting quarterly jetting.]</p>
HTML,
        ],
        [
            'heading' => 'Pricing Form',
            'tip'     => 'Use the owner\'s pricing form exactly as issued and mirror it here only as a supplement. Unit prices should be per assembly (by type and size) and per interceptor pumping (by capacity), since counts will change. Make sure extended totals match the inventory, and never leave a cell blank — write "Included" or "N/A."',
            'body'    => <<<'HTML'
<p>The pricing below corresponds to Exhibit [C] of {{solicitation_number}}. [Prices include / exclude] applicable sales tax. Disposal fees [are / are not] included in interceptor pricing.</p>
<h4>A. Backflow Testing (per assembly, annual)</h4>
<table>
<thead>
<tr><th>Assembly Type</th><th>Size</th><th>Qty</th><th>Unit Price</th><th>Extended</th></tr>
</thead>
<tbody>
<tr><td>RP / DC</td><td>3/4"–2"</td><td>[#]</td><td>$[amount]</td><td>$[amount]</td></tr>
<tr><td>RP / DC</td><td>2-1/2"–4"</td><td>[#]</td><td>$[amount]</td><td>$[amount]</td></tr>
<tr><td>RP / DC / DCDA / RPDA</td><td>6"–10"</td><td>[#]</td><td>$[amount]</td><td>$[amount]</td></tr>
<tr><td>PVB / SVB</td><td>All</td><td>[#]</td><td>$[amount]</td><td>$[amount]</td></tr>
<tr><td>Purveyor filing fee (pass-through)</td><td>—</td><td>[#]</td><td>$[amount]</td><td>$[amount]</td></tr>
<tr><td>Retest after repair</td><td>—</td><td>As needed</td><td>$[amount]</td><td>—</td></tr>
</tbody>
</table>
<h4>B. Grease Interceptor / Trap Service (per pumping)</h4>
<table>
<thead>
<tr><th>Capacity</th><th>Qty</th><th>Services per Year</th><th>Price per Service</th><th>Annual Extended</th></tr>
</thead>
<tbody>
<tr><td>Under-sink trap (up to [100] lb)</td><td>[#]</td><td>[12]</td><td>$[amount]</td><td>$[amount]</td></tr>
<tr><td>Interceptor up to 1,000 gal</td><td>[#]</td><td>[4]</td><td>$[amount]</td><td>$[amount]</td></tr>
<tr><td>Interceptor 1,001–2,000 gal</td><td>[#]</td><td>[4]</td><td>$[amount]</td><td>$[amount]</td></tr>
<tr><td>Additional gallons over rated capacity</td><td>—</td><td>—</td><td>$[amount]/gal</td><td>—</td></tr>
</tbody>
</table>
<h4>C. Drain Maintenance & Preventive Maintenance (annual, by site)</h4>
<table>
<thead>
<tr><th>Site</th><th>Jetting & Camera</th><th>Plumbing PM</th><th>Year 1 Total</th><th>Year 2</th><th>Year 3</th></tr>
</thead>
<tbody>
<tr><td>[Site 1]</td><td>$[amount]</td><td>$[amount]</td><td>$[amount]</td><td>$[amount]</td><td>$[amount]</td></tr>
<tr><td>[Site 2]</td><td>$[amount]</td><td>$[amount]</td><td>$[amount]</td><td>$[amount]</td><td>$[amount]</td></tr>
<tr><td>[Site 3]</td><td>$[amount]</td><td>$[amount]</td><td>$[amount]</td><td>$[amount]</td><td>$[amount]</td></tr>
</tbody>
</table>
<h4>D. Total Annual Recurring Price</h4>
<table>
<thead>
<tr><th>Component</th><th>Year 1</th><th>Year 2</th><th>Year 3</th></tr>
</thead>
<tbody>
<tr><td>Backflow testing</td><td>$[amount]</td><td>$[amount]</td><td>$[amount]</td></tr>
<tr><td>Grease interceptor / trap service</td><td>$[amount]</td><td>$[amount]</td><td>$[amount]</td></tr>
<tr><td>Drain maintenance and plumbing PM</td><td>$[amount]</td><td>$[amount]</td><td>$[amount]</td></tr>
<tr><td><strong>Total</strong></td><td><strong>$[amount]</strong></td><td><strong>$[amount]</strong></td><td><strong>$[amount]</strong></td></tr>
</tbody>
</table>
<p>Renewal escalation not to exceed [3]% or [CPI index] per year. [If the RFP defines an evaluated price formula — e.g., recurring price plus an assumed number of service hours — show it here exactly as defined.]</p>
<h4>E. Common Repair Unit Prices (optional)</h4>
<table>
<thead>
<tr><th>Item</th><th>Price (labor + standard materials)</th></tr>
</thead>
<tbody>
<tr><td>Backflow repair kit install — RP 3/4"–2"</td><td>$[amount]</td></tr>
<tr><td>Flush valve rebuild</td><td>$[amount]</td></tr>
<tr><td>Replace commercial faucet (owner-standard model)</td><td>$[amount]</td></tr>
<tr><td>Main line clearing (cable), first [100] ft</td><td>$[amount]</td></tr>
<tr><td>Camera inspection with report</td><td>$[amount]</td></tr>
<tr><td>Replace [#]-gallon commercial water heater</td><td>$[amount]</td></tr>
</tbody>
</table>
HTML,
        ],
        [
            'heading' => 'Labor Rates, Markups & Billing',
            'tip'     => 'Break out rates by classification and time of day, and state trip charges, minimum billing, and billing increments plainly. Specialty equipment (jetter, camera, vac truck) should carry an hourly or per-use rate so repairs aren\'t disputed. For public work, verify rates against the applicable prevailing wage determination.',
            'body'    => <<<'HTML'
<h4>Hourly Labor Rates</h4>
<table>
<thead>
<tr><th>Classification</th><th>Regular</th><th>After Hours / Saturday</th><th>Sunday / Holiday</th></tr>
</thead>
<tbody>
<tr><td>Master Plumber</td><td>$[rate]</td><td>$[rate]</td><td>$[rate]</td></tr>
<tr><td>Journeyman Plumber</td><td>$[rate]</td><td>$[rate]</td><td>$[rate]</td></tr>
<tr><td>Apprentice / Helper</td><td>$[rate]</td><td>$[rate]</td><td>$[rate]</td></tr>
<tr><td>Certified Backflow Tester (repair work)</td><td>$[rate]</td><td>$[rate]</td><td>$[rate]</td></tr>
<tr><td>Drain Technician</td><td>$[rate]</td><td>$[rate]</td><td>$[rate]</td></tr>
</tbody>
</table>
<h4>Equipment Rates</h4>
<table>
<thead>
<tr><th>Equipment</th><th>Rate</th></tr>
</thead>
<tbody>
<tr><td>Hydro-jetter (with operator)</td><td>$[rate] per hour, [#]-hour minimum</td></tr>
<tr><td>Sewer camera with locator and recorded report</td><td>$[rate] per [hour / inspection]</td></tr>
<tr><td>Vacuum truck (with operator)</td><td>$[rate] per hour + disposal at $[amount]/gal</td></tr>
<tr><td>Leak detection (electronic / acoustic)</td><td>$[rate] per hour</td></tr>
<tr><td>Mini-excavator / concrete saw</td><td>$[rate] per [day / hour]</td></tr>
</tbody>
</table>
<h4>Other Charges & Terms</h4>
<table>
<thead>
<tr><th>Item</th><th>Terms</th></tr>
</thead>
<tbody>
<tr><td>Trip charge</td><td>[$amount per call / None]</td></tr>
<tr><td>Minimum billing</td><td>[1] hour regular; [2] hours after hours; [15]-minute increments thereafter</td></tr>
<tr><td>Materials markup</td><td>Cost plus [Number]%; supplier invoices available on request</td></tr>
<tr><td>Subcontracted services</td><td>Cost plus [Number]%</td></tr>
<tr><td>Permit fees</td><td>At cost [plus $(amount) administration]</td></tr>
<tr><td>Billing</td><td>Recurring services billed [monthly / upon completion]; service calls invoiced within [5] business days</td></tr>
<tr><td>Payment terms</td><td>Net [30] days or per {{client_name}}'s standard terms</td></tr>
<tr><td>Prevailing wage</td><td>[Rates comply with the applicable prevailing wage determination; certified payroll submitted (weekly) / Not applicable]</td></tr>
</tbody>
</table>
HTML,
        ],
        [
            'heading' => 'Insurance, Required Forms & Exceptions',
            'tip'     => 'List required forms in the order the RFP specifies and consolidate every exception in one place. Common plumbing-specific exceptions include liability for pre-existing pipe conditions, damage from jetting deteriorated lines, and consequential water damage from failures of equipment you did not install — state them clearly with proposed alternate language.',
            'body'    => <<<'HTML'
<h4>Insurance</h4>
<p>{{firm_name}} will name {{client_name}} [and its property manager] as additional insured on a primary and non-contributory basis with waiver of subrogation, as required.</p>
<table>
<thead>
<tr><th>Coverage</th><th>Required by RFP</th><th>Our Limits</th><th>Carrier</th></tr>
</thead>
<tbody>
<tr><td>Commercial General Liability</td><td>$[amount] / $[amount] aggregate</td><td>$[amount] / $[amount]</td><td>[Carrier]</td></tr>
<tr><td>Automobile Liability</td><td>$[amount] CSL</td><td>$[amount]</td><td>[Carrier]</td></tr>
<tr><td>Workers' Compensation / Employer's Liability</td><td>Statutory / $[amount]</td><td>Statutory / $[amount]</td><td>[Carrier]</td></tr>
<tr><td>Umbrella / Excess</td><td>$[amount]</td><td>$[amount]</td><td>[Carrier]</td></tr>
<tr><td>Contractor's Pollution Liability</td><td>$[amount]</td><td>$[amount]</td><td>[Carrier]</td></tr>
</tbody>
</table>
<h4>Required Forms & Attachments</h4>
<ol>
<li>Signed Proposal / Bid Form</li>
<li>Addenda acknowledgment</li>
<li>Certificate of insurance with required endorsements</li>
<li>W-9</li>
<li>State plumbing contractor license ({{license_number}}) and master plumber license</li>
<li>Backflow tester certifications and test gauge calibration certificates</li>
<li>Vacuum truck / hauler permit and disposal facility information</li>
<li>[Non-collusion affidavit / debarment certification / conflict of interest disclosure]</li>
<li>[Prevailing wage acknowledgment / E-Verify / state-specific forms]</li>
<li>[Bid bond if required]</li>
<li>Sample service ticket, backflow test report, and FOG manifest</li>
</ol>
<h4>Exceptions & Clarifications</h4>
<ol>
<li>[If none: "{{firm_name}} takes no exception to the terms and conditions of {{solicitation_number}}."]</li>
<li>[Clarification: Jetting of deteriorated cast iron, clay, or Orangeburg lines carries inherent risk. Where our camera inspection shows significant deterioration, we will recommend an alternative method before proceeding.]</li>
<li>[Clarification: Recurring pricing assumes assemblies and interceptors are accessible without excavation, ceiling removal, or confined space rescue services beyond our standard procedures.]</li>
<li>[Clarification: Pre-existing deficiencies found at contract start will be reported and quoted separately.]</li>
<li>[Exception: Section (#) — describe term and proposed alternate language.]</li>
</ol>
<p>Submitted by {{contact_name}}, {{contact_title}}, on behalf of {{firm_name}}, {{submittal_date}}.</p>
<p>Signature: ______________________________ Date: ______________</p>
HTML,
        ],
    ],
];
