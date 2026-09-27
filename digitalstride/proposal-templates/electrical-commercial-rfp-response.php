<?php
if (!defined('ABSPATH')) exit;

return [
    'slug'     => 'electrical-commercial-rfp-response',
    'title'    => 'Electrical Contractor Commercial RFP / Bid Response',
    'industry' => 'electrical',
    'type'     => 'rfp',
    'summary'  => 'A complete response to a commercial RFP or GC bid invitation for electrical work — tenant improvement or LED lighting retrofit with controls — including scope matrix, bid form with alternates and unit prices, clarifications and exclusions, NFPA 70E safety, and optional ongoing maintenance with infrared thermography.',
    'use_when' => [
        'A general contractor has sent an Invitation to Bid for the Division 26 (electrical) scope of a tenant improvement',
        'A property manager, facilities director, school district, or municipality has issued an RFP for an LED lighting retrofit and lighting controls upgrade',
        'The solicitation asks for a base bid plus alternates, unit prices, and an optional annual maintenance / IR thermography program',
        'You need to show licensing, safety performance, insurance, and references in one organized, compliant package',
    ],
    'length'   => '10–18 pages plus attachments',

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
        'client_contact'      => 'Client contact person',
        'project_name'        => 'Project name',
        'project_location'    => 'Project address or location',
        'solicitation_number' => 'RFP / RFQ / bid number',
        'submittal_date'      => 'Submittal date',
        'master_electrician'  => 'Master / qualifying electrician name',
        'project_manager'     => 'Project manager name',
        'bid_validity_days'   => 'Bid validity (days)',
    ],

    'checklist' => [
        'Every addendum is acknowledged by number and date on the bid form, and the bid form is the owner\'s/GC\'s form if one was provided',
        'Base bid, each alternate, and each unit price are filled in with numbers and words that match — no blanks, no "TBD"',
        'Scope matrix reviewed line by line against the GC\'s bid-package scope sheet and the Division 26/27/28 specifications',
        'Clarifications and exclusions are specific (no blanket "per plans and specs" disclaimers) and do not contradict the bid form',
        'Fixture counts in the LED retrofit schedule reconciled against the lighting audit and reflected-ceiling plans',
        'Energy-code compliance approach for lighting controls (occupancy/vacancy, daylight, bi-level, auto shutoff) confirmed for the adopted code edition',
        'Utility incentive application requirements (pre-approval, spec sheets, DLC/ENERGY STAR listing) identified and timeline noted',
        'Electrical contractor license and qualifying master electrician license numbers verified current in the project jurisdiction',
        'Certificate of insurance matches the required limits, additional insureds, and waiver of subrogation wording',
        'Bid bond (if required) is on the correct form, in the right amount, and signed by the surety with power of attorney attached',
        'EMR letter from your insurance carrier and 3-year OSHA 300A summaries attached if safety data is requested',
        'NFPA 70E / energized work policy and site-specific safety plan outline included',
        'Prevailing wage / certified payroll acknowledgment signed if the project is public or funded with public money',
        'Schedule reflects long-lead items (switchgear, panelboards, lighting controls, fixtures) with current quoted lead times',
        'Compliance matrix mirrors the solicitation\'s numbering and every "shall" requirement points to a page in your response',
        'Response is within the page limit, in the required file format, and submitted before the deadline via the specified method',
    ],

    'sections' => [
        [
            'heading' => 'Cover Letter / Transmittal',
            'tip'     => 'Keep it to one page and sign it by an officer authorized to bind the company. State the base bid amount only if the solicitation allows pricing in the letter — many GCs and public owners require pricing to appear only on the bid form. Acknowledge every addendum here and again on the bid form; a missed addendum is the most common reason an otherwise low bid is thrown out.',
            'body'    => <<<'HTML'
<p>{{submittal_date}}</p>
<p>{{client_contact}}<br>{{client_name}}<br>[Client mailing address]</p>
<p><strong>RE: {{project_name}} — Electrical Scope — Solicitation No. {{solicitation_number}}</strong></p>
<p>Dear {{client_contact}},</p>
<p>{{firm_name}} is pleased to submit our response for the electrical work at {{project_name}}, located at {{project_location}}. We have reviewed the drawings dated [drawing issue date], the project manual / specifications Divisions [26, 27, 28 — list what applies], and Addenda Nos. [1 through X], and our pricing includes all of them.</p>
<p>We are a [licensed electrical contractor type — e.g., licensed commercial electrical contractor] with [Number] years in business and [Number] licensed electricians on staff. Over the past [Number] years we have completed [Number] projects of similar scope, including [Comparable project name — tenant improvement or lighting retrofit — size in SF or number of fixtures].</p>
<p>Our approach for this project centers on three things you told us matter: [priority 1 — e.g., no disruption to occupied floors during business hours], [priority 2 — e.g., meeting the energy-code controls requirements the first time], and [priority 3 — e.g., capturing the maximum available utility incentive].</p>
<p>This proposal remains valid for {{bid_validity_days}} days from the submittal date. {{project_manager}} will be your day-to-day contact, and {{master_electrician}} will serve as the qualifying master electrician of record. Please direct any questions to me at {{firm_phone}} or {{firm_email}}.</p>
<p>Respectfully submitted,</p>
<p>{{contact_name}}<br>{{contact_title}}<br>{{firm_name}}<br>{{firm_address}}<br>{{firm_website}}<br>License No. {{license_number}}</p>
HTML,
        ],
        [
            'heading' => 'Company Overview and Qualifications',
            'tip'     => 'Evaluators want proof you can handle this size and type of job, not a history of the company. Lead with the numbers that matter for this scope — annual volume, largest single contract, number of field electricians, and similar project count. If you self-perform low-voltage, fire alarm, or controls programming, say so; fewer subcontractor handoffs is a real selling point.',
            'body'    => <<<'HTML'
<p>{{firm_name}} has provided commercial electrical construction and service in [Service area / region] since [Year founded]. We self-perform [list — e.g., power distribution, branch wiring, lighting and controls, fire alarm, low-voltage structured cabling] with our own licensed crews.</p>
<table>
<thead>
<tr><th>Item</th><th>Response</th></tr>
</thead>
<tbody>
<tr><td>Legal name / entity type</td><td>[Legal company name — corporation / LLC — state of formation]</td></tr>
<tr><td>Years in business under current name</td><td>[Number]</td></tr>
<tr><td>Electrical contractor license(s)</td><td>{{license_number}} — [Issuing state / jurisdiction — expiration date]</td></tr>
<tr><td>Qualifying master electrician</td><td>{{master_electrician}} — License No. [Number]</td></tr>
<tr><td>Field personnel</td><td>[Number] journeyman / [Number] master / [Number] apprentices</td></tr>
<tr><td>Average annual revenue (last 3 years)</td><td>$[Amount]</td></tr>
<tr><td>Largest single electrical contract completed</td><td>$[Amount] — [Project name — year]</td></tr>
<tr><td>Union / open shop</td><td>[IBEW Local No. — or open shop]</td></tr>
<tr><td>Certifications</td><td>[MBE / WBE / DBE / SBE / veteran-owned — certifying agency and number, or "None"]</td></tr>
<tr><td>Manufacturer / controls certifications</td><td>[Lighting controls manufacturer start-up certifications held by our technicians, if any]</td></tr>
</tbody>
</table>
<p>Our commercial work includes [percentage]% tenant improvements, [percentage]% lighting retrofits and energy upgrades, and [percentage]% service and maintenance. We maintain [Number] service vehicles and a [Number]-hour emergency response line.</p>
HTML,
        ],
        [
            'heading' => 'Understanding of the Project',
            'tip'     => 'Restate the project in your own words so the evaluator sees you actually read the documents. Call out one or two site-specific conditions (occupied building, existing gear age, ceiling type, after-hours access) — this is where you separate yourself from contractors who plugged numbers into a bid form.',
            'body'    => <<<'HTML'
<p>We understand {{client_name}} is [describe the project — e.g., renovating approximately [Number] SF on floor [Number] for a new tenant / retrofitting approximately [Number] existing fluorescent and HID fixtures to LED with networked lighting controls] at {{project_location}}.</p>
<p>Based on our review of the documents and our site walk on [Date of pre-bid meeting or site visit], the key conditions that will shape our work are:</p>
<ul>
<li><strong>Existing electrical service and distribution:</strong> [e.g., 480/277V 3-phase service with [Amperage]A main switchboard; existing panelboards on the floor are [age / condition]; available capacity to be verified by load study or 30-day metering per NEC 220.87].</li>
<li><strong>Occupancy and access:</strong> [e.g., adjacent suites remain occupied; noisy work and shutdowns must occur after [Time] or on weekends].</li>
<li><strong>Ceiling and fixture conditions:</strong> [e.g., 2x4 lay-in grid with recessed troffers; some fixtures above hard-lid ceilings requiring access panels].</li>
<li><strong>Energy-code controls:</strong> [Adopted energy code and edition — e.g., IECC or ASHRAE 90.1 edition] requires [occupancy/vacancy sensing, daylight-responsive controls, automatic shutoff, bi-level / high-end trim] in the affected spaces.</li>
<li><strong>Coordination:</strong> [e.g., demolition by others; fire alarm device relocations; low-voltage and security by owner's vendors].</li>
</ul>
<p>Our goal is to deliver a complete, inspected, and commissioned electrical installation by [Target completion date] with no unplanned outages to occupied areas.</p>
HTML,
        ],
        [
            'heading' => 'Scope of Work Matrix',
            'tip'     => 'A scope matrix is the fastest way for a GC to level your bid against others — use their bid-package scope sheet if one was provided and match its line items exactly. Mark every line "Included," "Excluded," or "By Others," and never leave an item ambiguous; scope gaps discovered after award become change-order fights.',
            'body'    => <<<'HTML'
<p>The following matrix confirms what {{firm_name}} has included in the base bid. Items are organized to match [the GC's bid package scope sheet / specification sections 26 05 00 through 26 56 00 — select one].</p>
<table>
<thead>
<tr><th>Scope item</th><th>Spec / sheet reference</th><th>Included</th><th>Excluded / by others</th><th>Notes</th></tr>
</thead>
<tbody>
<tr><td>Electrical demolition and make-safe of existing circuits</td><td>[26 05 05 / E-001]</td><td>X</td><td></td><td>[Includes removal and legal disposal of lamps and ballasts]</td></tr>
<tr><td>Temporary power and temporary lighting</td><td>[01 50 00]</td><td>[X or blank]</td><td>[X or blank]</td><td>[Specify sources and duration]</td></tr>
<tr><td>Service / distribution modifications (switchboard, panelboards, transformers)</td><td>[26 24 16 / E-601]</td><td>X</td><td></td><td>[New panel(s) and feeders as scheduled]</td></tr>
<tr><td>Branch circuit wiring and devices (receptacles, switches)</td><td>[26 27 26]</td><td>X</td><td></td><td>[MC cable permitted where allowed by spec]</td></tr>
<tr><td>AFCI / GFCI protection where required by NEC</td><td>[26 27 26]</td><td>X</td><td></td><td></td></tr>
<tr><td>Lighting fixtures — furnish and install</td><td>[26 51 00 / E-201]</td><td>X</td><td></td><td>[Per fixture schedule; see retrofit schedule below]</td></tr>
<tr><td>Lighting controls — sensors, dimming, networked system</td><td>[26 09 23]</td><td>X</td><td></td><td>[Includes manufacturer start-up and programming]</td></tr>
<tr><td>Emergency and exit lighting</td><td>[26 52 00]</td><td>X</td><td></td><td>[Includes 90-minute test at completion]</td></tr>
<tr><td>Mechanical equipment power connections</td><td>[26 05 00 / M-series]</td><td>X</td><td></td><td>[Disconnects and final connections; control wiring by mechanical]</td></tr>
<tr><td>Fire alarm devices — relocate / add</td><td>[28 31 00]</td><td>[X or blank]</td><td>[X or blank]</td><td>[State whether design-build FA shop drawings are included]</td></tr>
<tr><td>Low-voltage / data cabling</td><td>[27 10 00]</td><td></td><td>X</td><td>[Empty conduit and boxes with pull string included]</td></tr>
<tr><td>Grounding and bonding</td><td>[26 05 26]</td><td>X</td><td></td><td></td></tr>
<tr><td>Firestopping of electrical penetrations</td><td>[07 84 00]</td><td>X</td><td></td><td>[UL-listed systems per penetration type]</td></tr>
<tr><td>Cutting, patching, painting</td><td>[01 73 29]</td><td></td><td>X</td><td>[Core drilling included; patch and paint by others]</td></tr>
<tr><td>Arc-flash study / labeling update</td><td>[26 05 73]</td><td>[X or blank]</td><td>[X or blank]</td><td>[See Alternate No. X]</td></tr>
<tr><td>Permits and inspections (electrical)</td><td>[01 41 00]</td><td>X</td><td></td><td>[Electrical permit fee included; building permit by others]</td></tr>
<tr><td>As-built drawings and O&amp;M manuals</td><td>[01 78 00]</td><td>X</td><td></td><td>[Format: PDF redlines / CAD — specify]</td></tr>
</tbody>
</table>
HTML,
        ],
        [
            'heading' => 'LED Lighting Retrofit and Controls Approach',
            'tip'     => 'For retrofit RFPs, owners score the payback math and the incentive capture, so show existing vs. proposed wattage per fixture type. Only propose products that are DLC-listed or ENERGY STAR if the utility program requires it, and state whether you are doing full fixture replacement, retrofit kits, or lamp replacement (Type A/B/C tubes) — each has different UL listing and labor implications. Delete this section if the job is a pure tenant improvement.',
            'body'    => <<<'HTML'
<p>Based on our lighting audit of [Number] fixtures on [Date], we propose the following retrofit strategy. All proposed products are [DLC-listed / ENERGY STAR — confirm per utility program] and UL-listed for the application. Retrofit kits will be installed per their UL classification and the kit manufacturer's instructions, and the fixture will be relabeled accordingly.</p>
<table>
<thead>
<tr><th>Area / fixture type</th><th>Existing fixture &amp; watts</th><th>Proposed solution &amp; watts</th><th>Qty</th><th>Controls</th><th>Est. annual kWh saved</th></tr>
</thead>
<tbody>
<tr><td>[Open office — 2x4 troffer]</td><td>[3-lamp T8, [Number] W]</td><td>[LED retrofit kit / new flat panel, [Number] W]</td><td>[Qty]</td><td>[Occupancy + daylight zone]</td><td>[Number]</td></tr>
<tr><td>[Corridors]</td><td>[2-lamp T8, [Number] W]</td><td>[LED strip, [Number] W]</td><td>[Qty]</td><td>[Vacancy sensor, bi-level]</td><td>[Number]</td></tr>
<tr><td>[Warehouse / high bay]</td><td>[400 W metal halide, [Number] W with ballast]</td><td>[LED high bay, [Number] W]</td><td>[Qty]</td><td>[Integral sensor]</td><td>[Number]</td></tr>
<tr><td>[Parking lot / exterior]</td><td>[HID pole head, [Number] W]</td><td>[LED area light, [Number] W]</td><td>[Qty]</td><td>[Photocell + dusk-to-dawn dimming]</td><td>[Number]</td></tr>
<tr><td><strong>Total</strong></td><td>[Total existing kW]</td><td>[Total proposed kW]</td><td>[Total qty]</td><td></td><td>[Total kWh]</td></tr>
</tbody>
</table>
<h4>Controls strategy</h4>
<p>We will provide [networked lighting controls system — manufacturer to be confirmed / standalone sensor-based controls] meeting [Adopted energy code and edition]. The system includes occupancy and vacancy sensing, daylight-responsive dimming in daylight zones, high-end trim set to [percentage]% at commissioning, and automatic time-scheduled shutoff. Manufacturer start-up and our programming technician will commission each zone and deliver a sequence-of-operations document and a functional test report.</p>
<h4>Energy savings and incentives</h4>
<p>Using [Number] annual operating hours per area as documented in the audit and a blended rate of $[Rate]/kWh, estimated annual savings are [Number] kWh and $[Amount]. We will prepare and submit the [Utility name] [Program name] [prescriptive / custom] incentive application on your behalf, including spec sheets and pre- and post-installation documentation. Estimated incentive: $[Amount], subject to utility approval. Incentive amounts are set by the utility and are not guaranteed by {{firm_name}}.</p>
<h4>Disposal</h4>
<p>Fluorescent lamps, mercury-containing HID lamps, and ballasts (including any PCB-containing ballasts identified) will be packaged and sent to a licensed recycler. Certificates of recycling will be provided with closeout.</p>
HTML,
        ],
        [
            'heading' => 'Bid Form — Base Bid, Alternates, and Unit Prices',
            'tip'     => 'If the owner or GC provided a bid form, use theirs and attach this only as a supplement — a substituted form can make your bid non-responsive. Write amounts in both words and figures, and make sure each alternate states whether it adds or deducts. Unit prices should be all-in (labor, material, overhead, profit) and quoted for the quantity range you expect, since they are used to price change orders.',
            'body'    => <<<'HTML'
<p><strong>Project:</strong> {{project_name}}<br><strong>Solicitation No.:</strong> {{solicitation_number}}<br><strong>Bidder:</strong> {{firm_name}}</p>
<p>Addenda acknowledged: No. [1] dated [Date]; No. [2] dated [Date]; No. [X] dated [Date].</p>
<h4>Base bid</h4>
<table>
<thead>
<tr><th>Description</th><th>Amount (figures)</th><th>Amount (words)</th></tr>
</thead>
<tbody>
<tr><td>Base Bid — complete electrical scope per drawings, specifications, and addenda</td><td>$[Amount]</td><td>[Amount in words] dollars</td></tr>
</tbody>
</table>
<h4>Alternates</h4>
<table>
<thead>
<tr><th>Alt. No.</th><th>Description</th><th>Add / Deduct</th><th>Amount</th></tr>
</thead>
<tbody>
<tr><td>1</td><td>[e.g., Networked lighting controls in lieu of standalone sensors]</td><td>[Add]</td><td>$[Amount]</td></tr>
<tr><td>2</td><td>[e.g., Arc-flash risk assessment and labeling per NFPA 70E for affected distribution]</td><td>[Add]</td><td>$[Amount]</td></tr>
<tr><td>3</td><td>[e.g., Exterior site lighting retrofit]</td><td>[Add]</td><td>$[Amount]</td></tr>
<tr><td>4</td><td>[e.g., Premium-time (after-hours) work for all occupied-area tasks]</td><td>[Add]</td><td>$[Amount]</td></tr>
<tr><td>5</td><td>[e.g., Owner-furnished fixtures, contractor-installed]</td><td>[Deduct]</td><td>$[Amount]</td></tr>
</tbody>
</table>
<h4>Unit prices</h4>
<table>
<thead>
<tr><th>Item</th><th>Unit</th><th>Unit price (installed)</th></tr>
</thead>
<tbody>
<tr><td>Duplex receptacle, 20A, on existing circuit, up to [Number] ft of cable</td><td>Each</td><td>$[Amount]</td></tr>
<tr><td>New 20A 120V branch circuit, home run up to [Number] ft</td><td>Each</td><td>$[Amount]</td></tr>
<tr><td>Data / telecom box with conduit stub and pull string</td><td>Each</td><td>$[Amount]</td></tr>
<tr><td>2x4 LED troffer / retrofit kit, furnished and installed</td><td>Each</td><td>$[Amount]</td></tr>
<tr><td>Ceiling-mounted occupancy sensor with power pack</td><td>Each</td><td>$[Amount]</td></tr>
<tr><td>Additional EMT conduit, 3/4 in., with wire</td><td>Linear foot</td><td>$[Amount]</td></tr>
<tr><td>Journeyman electrician — straight time / overtime / premium time</td><td>Hour</td><td>$[Amount] / $[Amount] / $[Amount]</td></tr>
<tr><td>Apprentice — straight time / overtime</td><td>Hour</td><td>$[Amount] / $[Amount]</td></tr>
</tbody>
</table>
<p>Markup on change-order work: [percentage]% overhead and profit on our own work; [percentage]% on subcontracted work. This bid is valid for {{bid_validity_days}} days.</p>
<p>Authorized signature: ______________________<br>Name/Title: {{contact_name}}, {{contact_title}}<br>Date: ____________</p>
HTML,
        ],
        [
            'heading' => 'Optional Ongoing Maintenance and Infrared Thermography Program',
            'tip'     => 'A maintenance option turns a one-time project into recurring revenue, and facilities directors like seeing lifecycle thinking. Base task frequencies on NFPA 70B (which is now a standard, not just a recommended practice) and the equipment manufacturer\'s instructions, and price it as a separate annual line so it does not muddy the base-bid comparison. Thermography should be performed under at least 40% load where possible, by a certified thermographer.',
            'body'    => <<<'HTML'
<p>As an option separate from the base bid, {{firm_name}} offers an annual electrical preventive maintenance program for {{project_name}} aligned with NFPA 70B and the equipment manufacturers' recommendations.</p>
<table>
<thead>
<tr><th>Task</th><th>Equipment covered</th><th>Frequency</th><th>Deliverable</th></tr>
</thead>
<tbody>
<tr><td>Infrared (IR) thermography scan under load</td><td>Switchboards, panelboards, disconnects, transformers, MCCs</td><td>[Annually]</td><td>Report with thermal and visual images, temperature rise, severity rating, and recommended action</td></tr>
<tr><td>Visual inspection and cleaning</td><td>Distribution equipment and enclosures</td><td>[Annually]</td><td>Checklist with deficiencies noted</td></tr>
<tr><td>Torque verification of accessible connections (de-energized)</td><td>[Main switchboard / selected panels]</td><td>[Every 3 years or per condition]</td><td>Torque log</td></tr>
<tr><td>Lighting controls functional test and schedule review</td><td>Sensors, daylight zones, time schedules</td><td>[Semi-annually]</td><td>Controls test report</td></tr>
<tr><td>Emergency / exit lighting test</td><td>All emergency and exit fixtures</td><td>[Monthly 30-second / annual 90-minute — confirm AHJ]</td><td>Test log for fire marshal</td></tr>
<tr><td>Arc-flash label review</td><td>Labeled equipment</td><td>[Annually; study update every 5 years or on system change]</td><td>Label condition report</td></tr>
</tbody>
</table>
<table>
<thead>
<tr><th>Service level</th><th>Commitment</th></tr>
</thead>
<tbody>
<tr><td>Emergency response (loss of power, safety hazard)</td><td>On site within [Number] hours, 24/7/365</td></tr>
<tr><td>Urgent (partial outage, failed circuit)</td><td>On site within [Number] hours during business days</td></tr>
<tr><td>Routine service request</td><td>Scheduled within [Number] business days</td></tr>
<tr><td>Hourly rates — regular / after-hours / holiday</td><td>$[Amount] / $[Amount] / $[Amount]</td></tr>
<tr><td>Parts markup under maintenance agreement</td><td>[percentage]%</td></tr>
</tbody>
</table>
<p><strong>Annual maintenance price:</strong> $[Amount] per year, billed [annually / quarterly], for an initial term of [Number] year(s), renewable by mutual agreement.</p>
<p>IR thermography is performed by [Name — thermographer certification level and certifying body].</p>
HTML,
        ],
        [
            'heading' => 'Clarifications and Exclusions',
            'tip'     => 'Clarifications should narrow genuine ambiguity, not rewrite the contract — GCs and public owners often reject bids with long, sweeping exclusion lists. Tie each item to a spec section or drawing note. Common legitimate items: utility company fees, arc-flash studies not specified, patching/painting, concealed conditions, and owner-furnished equipment warranties.',
            'body'    => <<<'HTML'
<h4>Clarifications</h4>
<ol>
<li>Pricing is based on drawings [Sheet list and issue date] and specifications dated [Date], including Addenda [Numbers].</li>
<li>Work in occupied areas is priced [during normal hours of [Time] to [Time] / after hours as noted]. Premium-time work beyond this is covered by Alternate No. [X] or unit rates.</li>
<li>MC cable is included for concealed branch circuits where permitted by the specifications and NEC; EMT is included for exposed work and all feeders.</li>
<li>Existing circuits to remain are assumed to be in code-compliant condition. Deficiencies discovered in existing wiring outside the scope will be reported and priced separately.</li>
<li>Lighting fixtures and controls are based on the scheduled basis-of-design products. Substitutions, if any, are listed in [Attachment X] with pricing differences.</li>
<li>One mobilization is included for each phase shown in the schedule. Additional mobilizations requested by others: $[Amount] each.</li>
<li>Available service capacity for new loads is based on [the engineer's load calculation / owner-provided 12 months of demand data]. We have not independently verified capacity unless Alternate No. [X] is accepted.</li>
</ol>
<h4>Exclusions</h4>
<ol>
<li>Utility company charges, fees, and service-work costs, unless listed in the scope matrix.</li>
<li>Patching, painting, and ceiling tile replacement other than damage we cause.</li>
<li>Low-voltage cabling, security, audio-visual, and access control beyond empty raceway.</li>
<li>Asbestos, lead, PCB, or other hazardous material abatement (we will stop work and notify if suspect materials are encountered). Recycling of lamps and non-PCB ballasts is included.</li>
<li>Bond premium, unless required by the solicitation (add [percentage]% if required).</li>
<li>[Additional project-specific exclusion tied to a spec section]</li>
</ol>
HTML,
        ],
        [
            'heading' => 'Project Schedule and Phasing',
            'tip'     => 'Show your schedule in the owner\'s milestones, not just durations, and call out long-lead items with current quoted lead times — switchgear and some panelboards can run many months. For occupied buildings, a floor-by-floor or zone-by-zone phasing table shows you have thought through disruption, which facilities evaluators weigh heavily.',
            'body'    => <<<'HTML'
<p>We can mobilize within [Number] calendar days of notice to proceed and substantially complete the work in [Number] working days, subject to material lead times listed below.</p>
<table>
<thead>
<tr><th>Milestone / phase</th><th>Duration</th><th>Target date</th><th>Notes</th></tr>
</thead>
<tbody>
<tr><td>Notice to proceed / contract execution</td><td>—</td><td>[Date]</td><td></td></tr>
<tr><td>Submittals (fixtures, controls, gear) to engineer</td><td>[Number] days</td><td>[Date]</td><td>[Complete package within X days of NTP]</td></tr>
<tr><td>Long-lead procurement — panelboards / switchgear</td><td>[Number] weeks</td><td>[Date]</td><td>[Current quoted lead time]</td></tr>
<tr><td>Long-lead procurement — fixtures and controls</td><td>[Number] weeks</td><td>[Date]</td><td></td></tr>
<tr><td>Phase 1 — [Area / floor]: demo, rough-in, inspection</td><td>[Number] days</td><td>[Date]</td><td>[Work hours]</td></tr>
<tr><td>Phase 2 — [Area / floor]: rough-in, trim, fixtures</td><td>[Number] days</td><td>[Date]</td><td></td></tr>
<tr><td>Planned power shutdown(s)</td><td>[Number] hours each</td><td>[Date(s)]</td><td>[Weekend — coordinated 7 days in advance]</td></tr>
<tr><td>Controls programming and commissioning</td><td>[Number] days</td><td>[Date]</td><td>With manufacturer start-up</td></tr>
<tr><td>Final electrical inspection</td><td>—</td><td>[Date]</td><td></td></tr>
<tr><td>Punch list and closeout documents</td><td>[Number] days</td><td>[Date]</td><td></td></tr>
</tbody>
</table>
<p>All planned shutdowns will be requested in writing at least [Number] business days in advance, with a method-of-procedure (MOP) describing sequence, duration, affected loads, and back-out plan.</p>
HTML,
        ],
        [
            'heading' => 'Safety Program and NFPA 70E Compliance',
            'tip'     => 'Many owners and GCs pre-screen on EMR (1.0 is industry average; below 1.0 is better) and OSHA TRIR/DART — provide three years and attach the carrier\'s EMR letter rather than just typing a number. Electrical-specific credibility comes from your energized-work policy: state plainly that you de-energize and verify (LOTO) as the default, and that energized work requires a written permit under NFPA 70E.',
            'body'    => <<<'HTML'
<table>
<thead>
<tr><th>Safety metric</th><th>[Year 1]</th><th>[Year 2]</th><th>[Year 3]</th></tr>
</thead>
<tbody>
<tr><td>Experience Modification Rate (EMR)</td><td>[Number]</td><td>[Number]</td><td>[Number]</td></tr>
<tr><td>OSHA recordable incident rate (TRIR)</td><td>[Number]</td><td>[Number]</td><td>[Number]</td></tr>
<tr><td>DART rate</td><td>[Number]</td><td>[Number]</td><td>[Number]</td></tr>
<tr><td>Fatalities</td><td>[Number]</td><td>[Number]</td><td>[Number]</td></tr>
<tr><td>OSHA citations</td><td>[Number / description]</td><td>[Number / description]</td><td>[Number / description]</td></tr>
</tbody>
</table>
<p>Safety is managed by [Name — Safety Director / title], who reports directly to [Owner / President]. Our written safety program includes:</p>
<ul>
<li><strong>Electrically safe work condition as the default.</strong> We de-energize, apply lockout/tagout, and test for absence of voltage before work begins. Energized work is performed only when justified under NFPA 70E, with a written energized electrical work permit approved by [Title].</li>
<li><strong>Qualified persons.</strong> All electricians receive NFPA 70E training at least every [3] years, and our PPE program uses arc-flash labels or the NFPA 70E table method to select arc-rated clothing and equipment.</li>
<li><strong>Site-specific safety plan</strong> submitted before mobilization, including hazard analysis for each phase, shutdown procedures, and fall protection for lift and ladder work.</li>
<li><strong>Training:</strong> OSHA 10 for all field staff and OSHA 30 for foremen and superintendents; [aerial lift, first aid/CPR, confined space as applicable].</li>
<li><strong>Daily and weekly practices:</strong> pre-task planning / JHA each shift, weekly toolbox talks, and documented jobsite inspections.</li>
<li><strong>Incident reporting</strong> to the GC / owner within [Number] hours, with root-cause review.</li>
</ul>
<p>Attached: EMR letter from [Insurance carrier], OSHA 300A summaries for [Years], and safety program table of contents.</p>
HTML,
        ],
        [
            'heading' => 'Project Team and Organization',
            'tip'     => 'Name actual people and commit them — evaluators discount "or equal" staffing. Include the licensed master electrician of record, because many jurisdictions require the qualifying license holder to be responsible for the permit. Keep resumes to a half page each and attach them; put the summary table here.',
            'body'    => <<<'HTML'
<table>
<thead>
<tr><th>Role</th><th>Name</th><th>License / certifications</th><th>Years experience</th><th>Similar projects</th></tr>
</thead>
<tbody>
<tr><td>Project Executive</td><td>{{contact_name}}</td><td>[Licenses / certifications]</td><td>[Number]</td><td>[Project names]</td></tr>
<tr><td>Project Manager</td><td>{{project_manager}}</td><td>[Certifications]</td><td>[Number]</td><td>[Project names]</td></tr>
<tr><td>Master Electrician of Record</td><td>{{master_electrician}}</td><td>Master Electrician No. [Number]</td><td>[Number]</td><td>[Project names]</td></tr>
<tr><td>General Foreman / Superintendent</td><td>[Name]</td><td>[Journeyman No. — OSHA 30]</td><td>[Number]</td><td>[Project names]</td></tr>
<tr><td>Lighting Controls Technician</td><td>[Name]</td><td>[Manufacturer certification]</td><td>[Number]</td><td>[Project names]</td></tr>
<tr><td>Safety Director</td><td>[Name]</td><td>[Certification]</td><td>[Number]</td><td>—</td></tr>
</tbody>
</table>
<p>Peak field manpower for this project is estimated at [Number] electricians, with an average crew of [Number]. Crew assignments will not change without written notice to {{client_contact}}. Resumes are provided in [Attachment X].</p>
HTML,
        ],
        [
            'heading' => 'Licensing, Insurance, and Bonding',
            'tip'     => 'Match the insurance table exactly to the solicitation\'s requirements and attach a sample COI showing additional insured and waiver of subrogation endorsements. For public projects, confirm prevailing-wage and certified payroll obligations here. If a bid bond is required, it is usually 5–10% of the bid — confirm the exact percentage and form.',
            'body'    => <<<'HTML'
<h4>Licensing</h4>
<ul>
<li>Electrical contractor license: {{license_number}} — [Jurisdiction — expiration date]</li>
<li>Master electrician of record: {{master_electrician}} — License No. [Number] — [Jurisdiction]</li>
<li>[Local business license / registration — number]</li>
<li>[Fire alarm / low-voltage license if required — number]</li>
</ul>
<h4>Insurance</h4>
<table>
<thead>
<tr><th>Coverage</th><th>Required limit</th><th>Our limit</th><th>Carrier</th></tr>
</thead>
<tbody>
<tr><td>Commercial General Liability (each occurrence / aggregate)</td><td>$[Amount] / $[Amount]</td><td>$[Amount] / $[Amount]</td><td>[Carrier]</td></tr>
<tr><td>Automobile Liability (combined single limit)</td><td>$[Amount]</td><td>$[Amount]</td><td>[Carrier]</td></tr>
<tr><td>Workers' Compensation / Employer's Liability</td><td>Statutory / $[Amount]</td><td>Statutory / $[Amount]</td><td>[Carrier]</td></tr>
<tr><td>Umbrella / Excess</td><td>$[Amount]</td><td>$[Amount]</td><td>[Carrier]</td></tr>
</tbody>
</table>
<p>{{client_name}} [and the GC / owner / others as specified] will be named as additional insured on a primary and non-contributory basis, with waiver of subrogation, as required by the contract documents.</p>
<h4>Bonding</h4>
<p>{{firm_name}} is bonded through [Surety company], with single-project capacity of $[Amount] and aggregate capacity of $[Amount]. [A bid bond in the amount of [percentage]% is enclosed. / Performance and payment bonds are available at a cost of [percentage]% of contract value.] Surety contact: [Agent name — phone].</p>
<h4>Prevailing wage</h4>
<p>[If applicable:] We acknowledge that this project is subject to [Davis-Bacon / state prevailing wage law] and will submit certified payroll [weekly] in the required format.</p>
HTML,
        ],
        [
            'heading' => 'Relevant Experience and References',
            'tip'     => 'Pick three to five projects that match this one in type (TI vs. retrofit), size, and occupancy condition — a hospital retrofit is a better reference for an occupied office than a ground-up warehouse. Call your references before listing them so they expect the call, and confirm their phone numbers are current.',
            'body'    => <<<'HTML'
<table>
<thead>
<tr><th>Project / location</th><th>Scope</th><th>Contract value</th><th>Completed</th><th>Reference (name, title, phone, email)</th></tr>
</thead>
<tbody>
<tr><td>[Project name — City, ST]</td><td>[e.g., [Number] SF office TI; new panelboards, LED lighting, networked controls]</td><td>$[Amount]</td><td>[Month / year]</td><td>[Name — title — phone — email]</td></tr>
<tr><td>[Project name — City, ST]</td><td>[e.g., [Number]-fixture LED retrofit in occupied school, after-hours]</td><td>$[Amount]</td><td>[Month / year]</td><td>[Name — title — phone — email]</td></tr>
<tr><td>[Project name — City, ST]</td><td>[e.g., Service upgrade and switchboard replacement with weekend shutdown]</td><td>$[Amount]</td><td>[Month / year]</td><td>[Name — title — phone — email]</td></tr>
<tr><td>[Project name — City, ST]</td><td>[e.g., Annual maintenance and IR thermography for [Number]-building campus]</td><td>$[Amount]/yr</td><td>[Ongoing since year]</td><td>[Name — title — phone — email]</td></tr>
</tbody>
</table>
<p>For [Project name], we [one or two sentences on a result — e.g., completed all occupied-floor work after hours with zero unplanned outages and captured $[Amount] in utility incentives for the owner].</p>
HTML,
        ],
        [
            'heading' => 'Warranty, Commissioning, and Closeout',
            'tip'     => 'State the workmanship warranty (commonly one year from substantial completion unless the specs say otherwise) separately from manufacturer warranties, which vary widely for LED fixtures and drivers. Owners value a clear closeout list — it signals you will not leave them chasing O&M manuals months later.',
            'body'    => <<<'HTML'
<p>{{firm_name}} warrants our workmanship for [Number] year(s) from the date of substantial completion. Manufacturer warranties pass through to {{client_name}} as follows:</p>
<ul>
<li>LED fixtures and drivers: [Number]-year manufacturer warranty — [Manufacturer]</li>
<li>Lighting controls system: [Number]-year manufacturer warranty — [Manufacturer]</li>
<li>Panelboards / distribution equipment: [Number]-year manufacturer warranty — [Manufacturer]</li>
</ul>
<p>At closeout we will deliver:</p>
<ul>
<li>As-built drawings in [PDF / CAD] format reflecting actual circuit routing and panel changes</li>
<li>Updated typed panel directories for every panel we touched</li>
<li>O&amp;M manuals, product data, and warranty certificates</li>
<li>Lighting controls sequence of operations, programming backup, and functional test reports</li>
<li>Emergency lighting 90-minute test report</li>
<li>Final inspection sign-off and lamp/ballast recycling certificates</li>
<li>[Number] hours of owner training on the lighting controls system for facility staff</li>
</ul>
HTML,
        ],
        [
            'heading' => 'Compliance Matrix / Requirements Cross-Reference',
            'tip'     => 'Mirror the solicitation\'s exact section numbering and wording — evaluators check the matrix first to confirm responsiveness, and many public RFPs score it pass/fail. Every "shall," "must," and required form belongs here with a page reference. If you take an exception to anything, say so here rather than burying it.',
            'body'    => <<<'HTML'
<table>
<thead>
<tr><th>RFP section</th><th>Requirement</th><th>Complies (Y / N / Exception)</th><th>Response location</th></tr>
</thead>
<tbody>
<tr><td>[1.1]</td><td>[Transmittal letter signed by authorized officer]</td><td>[Y]</td><td>Cover Letter, p. [X]</td></tr>
<tr><td>[2.1]</td><td>[Contractor license in [State] and qualifying master electrician]</td><td>[Y]</td><td>Licensing, p. [X]</td></tr>
<tr><td>[2.2]</td><td>[Minimum [Number] years experience and [Number] similar projects]</td><td>[Y]</td><td>Experience, p. [X]</td></tr>
<tr><td>[3.1]</td><td>[Scope of work acknowledgment]</td><td>[Y]</td><td>Scope Matrix, p. [X]</td></tr>
<tr><td>[3.4]</td><td>[Energy-code compliant lighting controls]</td><td>[Y]</td><td>Retrofit and Controls, p. [X]</td></tr>
<tr><td>[4.1]</td><td>[Bid form with base bid, alternates, unit prices]</td><td>[Y]</td><td>Bid Form, p. [X]</td></tr>
<tr><td>[4.3]</td><td>[Acknowledgment of all addenda]</td><td>[Y]</td><td>Bid Form, p. [X]</td></tr>
<tr><td>[5.1]</td><td>[Schedule with milestones]</td><td>[Y]</td><td>Schedule, p. [X]</td></tr>
<tr><td>[5.2]</td><td>[Safety program, EMR, OSHA logs]</td><td>[Y]</td><td>Safety, p. [X]; Attachment [X]</td></tr>
<tr><td>[6.1]</td><td>[Insurance certificate meeting limits]</td><td>[Y]</td><td>Attachment [X]</td></tr>
<tr><td>[6.2]</td><td>[Bid bond — [percentage]%]</td><td>[Y / N/A]</td><td>Attachment [X]</td></tr>
<tr><td>[6.4]</td><td>[Prevailing wage / certified payroll acknowledgment]</td><td>[Y / N/A]</td><td>Licensing, Insurance, and Bonding, p. [X]</td></tr>
<tr><td>[7.1]</td><td>[Three references for similar work]</td><td>[Y]</td><td>References, p. [X]</td></tr>
<tr><td>[7.3]</td><td>[Optional maintenance pricing]</td><td>[Y]</td><td>Maintenance Program, p. [X]</td></tr>
<tr><td>[Form X]</td><td>[Non-collusion affidavit / W-9 / MWBE forms]</td><td>[Y]</td><td>Attachment [X]</td></tr>
</tbody>
</table>
<p><strong>Exceptions taken:</strong> [None / list each exception with the RFP section and a brief reason].</p>
<h4>Attachments</h4>
<ol>
<li>Signed bid form and addenda acknowledgments</li>
<li>Bid bond (if required)</li>
<li>Certificate of insurance (sample with endorsements)</li>
<li>EMR letter and OSHA 300A summaries</li>
<li>Key personnel resumes</li>
<li>Product data for basis-of-design fixtures and controls (and any proposed substitutions)</li>
<li>[Required owner forms — W-9, non-collusion affidavit, MWBE participation plan]</li>
</ol>
HTML,
        ],
    ],
];
