<?php
if (!defined('ABSPATH')) exit;

return [
    'slug'     => 'construction-rfq-prequalification',
    'title'    => 'GC / CM at-Risk RFQ & Prequalification Response',
    'industry' => 'construction',
    'type'     => 'rfp',
    'summary'  => 'A complete Statement of Qualifications for general contractor or CM at-risk selection: firm profile, safety record (EMR/TRIR/DART), bonding and financial capacity, key personnel, relevant projects, preconstruction approach, MWBE plan, and a compliance matrix.',
    'use_when' => [
        'An owner, public agency, or developer has issued an RFQ or prequalification for GC, CM at-risk, or design-build contractor services',
        'You must be prequalified before you are allowed to bid a public or private project',
        'A two-step selection (RFQ shortlist, then RFP/interview with fee and general conditions)',
        'An owner or lender asks for an AIA A305 or ConsensusDocs 721 qualification statement',
    ],
    'length'   => '20–40 pages plus appendices (resumes, financials, safety records)',

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
        'delivery_method'     => 'Delivery method (e.g., CM at-Risk, General Contractor, Design-Build)',
        'surety_name'         => 'Surety company',
        'project_executive'   => 'Project executive name',
        'project_manager'     => 'Project manager name',
        'superintendent'      => 'Superintendent name',
    ],

    'checklist' => [
        'Every item in the RFQ is answered and cross-referenced in the compliance matrix using the owner\'s exact numbering',
        'Page limits, font size, tab order, and file-naming rules followed exactly (count the pages that count)',
        'EMR letter from your insurance carrier or broker covers the last 3 years and is on their letterhead',
        'OSHA 300A summaries for the last 3 years attached; TRIR and DART in the table match the 300A math',
        'Surety letter is current (dated within the last 60–90 days) and states single-project and aggregate capacity',
        'Financial statements are the type requested (CPA-reviewed or audited) and sealed or separately submitted if confidential',
        'Contractor license numbers, classifications, and expiration dates verified on the state board website',
        'Key personnel named are actually available for this project\'s schedule — and resumes show the projects listed',
        'Every relevant project includes owner reference with current phone and email, and each reference has been called and warned',
        'Project costs, sizes, and completion dates are consistent across the narrative, project sheets, and resumes',
        'MWBE / DBE / SBE participation plan addresses the stated goal and names outreach steps, not just a percentage',
        'All required owner forms signed and notarized where required (affidavits, non-collusion, debarment, E-Verify)',
        'Litigation, claims, and default disclosure answered truthfully — "none" only if genuinely none',
        'Certificate of insurance sample shows the limits requested (or a broker letter confirming you can meet them)',
        'Addenda acknowledged by number and date',
        'Submitted in the required format and number of copies before the deadline, with delivery confirmation',
    ],

    'sections' => [
        [
            'heading' => 'Cover Letter',
            'tip'     => 'Keep it to one page, signed by an officer who can bind the company. Name the project, the delivery method, your key people, and two or three proof points tied directly to the owner\'s stated priorities — not a generic company history. Many public RFQs require specific statements here (acknowledgment of addenda, validity period, authorized signer); check the instructions.',
            'body'    => <<<'HTML'
<p>{{submittal_date}}</p>
<p>{{client_contact}}<br>{{client_name}}<br>[Owner address]</p>
<p><strong>Re: {{solicitation_number}} — Request for Qualifications, {{delivery_method}} Services for {{project_name}}, {{project_location}}</strong></p>
<p>Dear {{client_contact}},</p>
<p>{{firm_name}} is pleased to submit our Statement of Qualifications to provide {{delivery_method}} services for {{project_name}}. We understand that {{client_name}} is seeking a builder who will [restate the owner's top two or three priorities from the RFQ — e.g., "hold a fixed budget of $[amount], deliver the building for a [month/year] opening, and keep an occupied campus safe and operating throughout construction"].</p>
<p>Over the past [number] years we have completed [number] projects of this type, including [project name] and [project name], both delivered [on schedule / within the GMP / with zero lost-time injuries — use only facts you can document]. Our proposed team — Project Executive {{project_executive}}, Project Manager {{project_manager}}, and Superintendent {{superintendent}} — has worked together on [number] prior projects and is available to begin preconstruction on [date].</p>
<p>In the enclosed submittal you will find:</p>
<ul>
<li>A current three-year EMR of [0.XX] and a [year] TRIR of [X.XX]</li>
<li>Bonding capacity of $[amount] single / $[amount] aggregate through {{surety_name}}</li>
<li>[Number] relevant projects with owner references</li>
<li>A preconstruction approach focused on [estimating accuracy / design-phase cost control / early procurement]</li>
<li>A participation plan to meet or exceed the [X]% MWBE goal</li>
</ul>
<p>We acknowledge receipt of Addenda [No. 1 dated MM/DD/YYYY, No. 2 dated MM/DD/YYYY]. This submittal remains valid for [90] days. I am authorized to bind {{firm_name}} and am your point of contact for this procurement at {{firm_phone}} or {{firm_email}}.</p>
<p>Sincerely,</p>
<p>{{contact_name}}<br>{{contact_title}}<br>{{firm_name}}<br>{{firm_address}}</p>
HTML,
        ],
        [
            'heading' => 'Firm Profile & Organization',
            'tip'     => 'This is where the AIA A305 Contractor\'s Qualification Statement "Organization" questions live — legal form, years in business, ownership, licenses. Answer them as data, not marketing. Evaluators want to confirm you are a real, stable, properly licensed entity in their jurisdiction; any mismatch between your legal name, license, and bond is a red flag.',
            'body'    => <<<'HTML'
<table>
<thead>
<tr><th>Item</th><th>Response</th></tr>
</thead>
<tbody>
<tr><td>Legal name of firm</td><td>{{firm_name}} [exact legal name as registered, including "Inc." / "LLC"]</td></tr>
<tr><td>Principal office</td><td>{{firm_address}}</td></tr>
<tr><td>Local / project office</td><td>[Address of office that will manage this project]</td></tr>
<tr><td>Form of business</td><td>[Corporation / LLC / Partnership / Joint Venture] — incorporated in [State], [Year]</td></tr>
<tr><td>Years in business under current name</td><td>[Number]</td></tr>
<tr><td>Prior names / predecessor firms</td><td>[Names and years, or "None"]</td></tr>
<tr><td>Officers / principals</td><td>[Name — Title — % ownership]</td></tr>
<tr><td>Federal EIN</td><td>[XX-XXXXXXX — or provide only if required]</td></tr>
<tr><td>Contractor license(s)</td><td>{{license_number}} — [State, classification, expiration date]</td></tr>
<tr><td>Small / diverse business certifications</td><td>[Certification, certifying agency, number, expiration — or "Not applicable"]</td></tr>
<tr><td>Union / open shop</td><td>[Signatory to (trades) / Open shop / Merit shop]</td></tr>
<tr><td>Total employees</td><td>[Number] salaried / [Number] craft</td></tr>
<tr><td>Average annual construction volume (last 3 years)</td><td>$[amount]</td></tr>
<tr><td>Website</td><td>{{firm_website}}</td></tr>
</tbody>
</table>
<h4>Company Overview</h4>
<p>{{firm_name}} is a [general contractor / construction manager] founded in [year] and headquartered in [city, state]. We build [primary markets — e.g., K–12 and higher education, healthcare, municipal, and commercial office] projects ranging from $[amount] to $[amount] in construction value. Approximately [X]% of our annual volume is [negotiated CM at-risk / design-build / hard bid] work, and [X]% is for repeat clients.</p>
<p>We self-perform [concrete, rough carpentry, doors/frames/hardware installation, general labor — list only what you truly self-perform], which gives us direct control of the early critical path and a reliable basis for checking subcontractor pricing.</p>
<h4>Organization Chart (Corporate)</h4>
<p>[Insert corporate org chart showing ownership, operations, preconstruction, safety, and accounting leadership, and where this project team reports.]</p>
HTML,
        ],
        [
            'heading' => 'Understanding of the Project',
            'tip'     => 'Show you read the RFQ and visited the site. Owners score this highly because it separates builders who will think about their project from those submitting boilerplate. Name specific risks — occupied site, utility capacity, long-lead equipment, phasing, weather window — and briefly how you would manage each.',
            'body'    => <<<'HTML'
<p>{{project_name}} is a [approx. size] square-foot [building type — e.g., three-story classroom addition and renovation] at {{project_location}}, with an estimated construction budget of $[amount] and a target [substantial completion / occupancy] of [month, year]. The design team is [architect of record] and the project is currently in [Schematic Design / Design Development].</p>
<p>From our review of the RFQ and our site visit on [date], we see the following as the project's critical success factors:</p>
<table>
<thead>
<tr><th>Challenge / Risk</th><th>Why it matters</th><th>Our approach</th></tr>
</thead>
<tbody>
<tr><td>[Occupied campus / adjacent operations]</td><td>[Student, patient, or tenant safety; noise and access constraints]</td><td>[Phased site logistics, separated construction entrance, after-hours shutdowns, ICRA or interim life safety measures]</td></tr>
<tr><td>[Long-lead equipment — switchgear, generators, RTUs, elevators]</td><td>[Current lead times of [X]–[X] weeks threaten the opening date]</td><td>[Early release package, owner-direct purchase evaluation, escalation tracking]</td></tr>
<tr><td>[Budget pressure vs. program]</td><td>[Program exceeds budget at current market pricing]</td><td>[Estimates at each design milestone with target-value reconciliation, live VE log]</td></tr>
<tr><td>[Site conditions — soils, utilities, stormwater]</td><td>[Unknown subsurface conditions carry cost and schedule risk]</td><td>[Early geotech review, potholing, utility locate, SWPPP coordination]</td></tr>
<tr><td>[Schedule constraint — e.g., summer-only work window]</td><td>[Must complete [scope] between [dates]]</td><td>[Pull-plan the window, prefabrication, pre-staged materials]</td></tr>
</tbody>
</table>
HTML,
        ],
        [
            'heading' => 'Safety Program & Record',
            'tip'     => 'Many owners set a hard pass/fail threshold — commonly EMR at or below 1.0, and TRIR / DART at or below the BLS industry average for your NAICS code. Calculate TRIR as (recordable cases × 200,000) ÷ total hours worked, straight from your OSHA 300A logs, and attach the carrier\'s EMR letter. If you have a blemish, explain it and show the corrective action; evaluators respect candor more than silence.',
            'body'    => <<<'HTML'
<h4>Safety Statistics (Last Three Years)</h4>
<table>
<thead>
<tr><th>Metric</th><th>[Year 1]</th><th>[Year 2]</th><th>[Year 3 / Current]</th></tr>
</thead>
<tbody>
<tr><td>Experience Modification Rate (EMR)</td><td>[0.XX]</td><td>[0.XX]</td><td>[0.XX]</td></tr>
<tr><td>Total hours worked</td><td>[Number]</td><td>[Number]</td><td>[Number]</td></tr>
<tr><td>OSHA recordable cases</td><td>[Number]</td><td>[Number]</td><td>[Number]</td></tr>
<tr><td>Total Recordable Incident Rate (TRIR)</td><td>[X.XX]</td><td>[X.XX]</td><td>[X.XX]</td></tr>
<tr><td>DART rate (days away, restricted, transferred)</td><td>[X.XX]</td><td>[X.XX]</td><td>[X.XX]</td></tr>
<tr><td>Lost-time cases</td><td>[Number]</td><td>[Number]</td><td>[Number]</td></tr>
<tr><td>Fatalities</td><td>[Number]</td><td>[Number]</td><td>[Number]</td></tr>
<tr><td>OSHA citations (serious / willful / repeat)</td><td>[Number — describe in narrative if any]</td><td>[Number]</td><td>[Number]</td></tr>
</tbody>
</table>
<p>NAICS code: [236220 — Commercial and Institutional Building Construction, or your code]. BLS industry average TRIR for this code: [X.X] ([year] data).</p>
<h4>Safety Program</h4>
<p>Safety at {{firm_name}} is led by [Name, CSP / CHST — Safety Director], who reports directly to [President / COO]. Our written safety program includes:</p>
<ul>
<li>Site-specific safety plan prepared before mobilization, including hazard analysis for each major phase</li>
<li>Daily pre-task planning (PTP / JHA) by every crew, reviewed by the superintendent</li>
<li>Weekly toolbox talks and weekly documented site safety inspections; monthly audits by the Safety Director</li>
<li>OSHA 30 for all superintendents and project managers; OSHA 10 required for all field personnel, including subcontractors</li>
<li>Subcontractor prequalification with EMR and TRIR thresholds of [X.XX] and [X.XX]</li>
<li>Fall protection at [6] feet, silica exposure control plan, excavation and trenching, crane and rigging, and hot work permitting programs</li>
<li>Incident investigation with root-cause analysis and lessons-learned distribution within [48] hours</li>
<li>Drug and alcohol testing program: [pre-employment, post-incident, reasonable suspicion, random]</li>
</ul>
<p>[If any EMR above 1.0, citation, or serious incident occurred in the last three years, describe it factually here, along with the corrective actions taken and results since.]</p>
HTML,
        ],
        [
            'heading' => 'Bonding Capacity',
            'tip'     => 'Attach an original surety letter (dated within the last 60–90 days) on surety letterhead, signed by the attorney-in-fact, stating single-project and aggregate limits. The surety should be on the U.S. Treasury Circular 570 list and meet any A.M. Best rating the owner specifies (commonly A- or better). A surety letter that names the specific project is stronger than a generic one.',
            'body'    => <<<'HTML'
<table>
<thead>
<tr><th>Item</th><th>Response</th></tr>
</thead>
<tbody>
<tr><td>Surety company</td><td>{{surety_name}}</td></tr>
<tr><td>A.M. Best rating / Treasury listed</td><td>[A / XV — listed on Treasury Circular 570: Yes]</td></tr>
<tr><td>Bonding agent / broker</td><td>[Agency name, contact name, phone, email]</td></tr>
<tr><td>Single-project bonding capacity</td><td>$[amount]</td></tr>
<tr><td>Aggregate bonding capacity</td><td>$[amount]</td></tr>
<tr><td>Current bonded backlog (uncompleted work)</td><td>$[amount]</td></tr>
<tr><td>Years with current surety</td><td>[Number]</td></tr>
<tr><td>Claims against bonds in past [10] years</td><td>[None / describe]</td></tr>
<tr><td>Has the firm ever failed to complete a contract?</td><td>[No / describe]</td></tr>
</tbody>
</table>
<p>{{firm_name}} can provide 100% Performance and 100% Payment Bonds for {{project_name}} at the anticipated contract value. A letter from {{surety_name}} confirming our capacity and willingness to bond this project is included in Appendix [X].</p>
HTML,
        ],
        [
            'heading' => 'Financial Capacity',
            'tip'     => 'Provide exactly what is asked — usually the last two or three years of CPA-reviewed or audited statements, often in a separate sealed envelope marked confidential (check whether your state\'s public records law protects them). Owners look at working capital, net worth, and backlog relative to the project size; a common rule of thumb is that one project should not exceed roughly 25–35% of your annual volume. Include a bank reference letter.',
            'body'    => <<<'HTML'
<table>
<thead>
<tr><th>Financial Indicator</th><th>[FY Year 1]</th><th>[FY Year 2]</th><th>[FY Year 3]</th></tr>
</thead>
<tbody>
<tr><td>Annual construction revenue</td><td>$[amount]</td><td>$[amount]</td><td>$[amount]</td></tr>
<tr><td>Working capital</td><td>$[amount]</td><td>$[amount]</td><td>$[amount]</td></tr>
<tr><td>Net worth / stockholders' equity</td><td>$[amount]</td><td>$[amount]</td><td>$[amount]</td></tr>
<tr><td>Current ratio</td><td>[X.X]</td><td>[X.X]</td><td>[X.X]</td></tr>
<tr><td>Backlog at year end</td><td>$[amount]</td><td>$[amount]</td><td>$[amount]</td></tr>
</tbody>
</table>
<ul>
<li><strong>Type of financial statements:</strong> [Audited / CPA-reviewed], prepared by [CPA firm name]</li>
<li><strong>Fiscal year end:</strong> [Month]</li>
<li><strong>Primary bank:</strong> [Bank name, relationship officer, phone] — line of credit of $[amount]</li>
<li><strong>Current backlog:</strong> $[amount], of which $[amount] is scheduled to be complete before {{project_name}} reaches peak activity</li>
<li><strong>Bankruptcy, liens, or judgments in the last [10] years:</strong> [None / describe]</li>
</ul>
<p>Financial statements are provided [in Appendix X / in a separate sealed envelope marked "Confidential Financial Information" as directed in RFQ Section X].</p>
HTML,
        ],
        [
            'heading' => 'Key Personnel',
            'tip'     => 'Owners hire people, not logos — this section is usually the highest-weighted criterion. Commit named individuals and include a statement that they will not be substituted without owner approval. Resumes should show projects of similar type and size in the proposed role, with years at your firm; the superintendent matters as much as the PM. Keep resumes to one or two pages each in the appendix.',
            'body'    => <<<'HTML'
<h4>Project Organization Chart</h4>
<p>[Insert project-specific org chart: owner, architect, {{firm_name}} project executive, preconstruction manager, estimator, project manager, superintendent, assistant superintendent, project engineer, safety, MEP coordinator, key self-perform foreman, and major subcontractors.]</p>
<h4>Key Personnel Summary</h4>
<table>
<thead>
<tr><th>Name</th><th>Proposed role</th><th>Years experience / with firm</th><th>% time — preconstruction / construction</th><th>Similar projects in this role</th></tr>
</thead>
<tbody>
<tr><td>{{project_executive}}</td><td>Project Executive</td><td>[XX] / [XX]</td><td>[20]% / [15]%</td><td>[Project, $ value]; [Project, $ value]</td></tr>
<tr><td>[Name]</td><td>Preconstruction Manager / Chief Estimator</td><td>[XX] / [XX]</td><td>[75]% / [10]%</td><td>[Project, $ value]; [Project, $ value]</td></tr>
<tr><td>{{project_manager}}</td><td>Project Manager</td><td>[XX] / [XX]</td><td>[50]% / [100]%</td><td>[Project, $ value]; [Project, $ value]</td></tr>
<tr><td>{{superintendent}}</td><td>Superintendent</td><td>[XX] / [XX]</td><td>[25]% / [100]%</td><td>[Project, $ value]; [Project, $ value]</td></tr>
<tr><td>[Name]</td><td>MEP Coordinator</td><td>[XX] / [XX]</td><td>[25]% / [50]%</td><td>[Project, $ value]</td></tr>
<tr><td>[Name, CSP]</td><td>Safety Manager</td><td>[XX] / [XX]</td><td>[5]% / [20]%</td><td>[Project, $ value]</td></tr>
</tbody>
</table>
<h4>Key Personnel Highlights</h4>
<p><strong>{{project_executive}}, Project Executive</strong> — [Two to three sentences: years of experience, number of similar projects, one specific result such as "led the $[X]M [Project] CM at-risk project, returning $[X] in unused contingency to the owner." Include education and credentials such as LEED AP, DBIA, CCM.]</p>
<p><strong>{{project_manager}}, Project Manager</strong> — [Two to three sentences, including day-to-day responsibility, owner communication, and relevant project experience.]</p>
<p><strong>{{superintendent}}, Superintendent</strong> — [Two to three sentences: field experience, occupied-site or phasing experience, OSHA 30, safety record on their projects.]</p>
<p>{{firm_name}} commits that the individuals named above will be assigned to {{project_name}} for its duration and will not be replaced without the prior written approval of {{client_name}}. Full resumes are provided in Appendix [X].</p>
HTML,
        ],
        [
            'heading' => 'Relevant Project Experience',
            'tip'     => 'Pick projects that match the owner\'s criteria — building type, size, delivery method, and recency (usually within 5–7 years). Lead with the ones your proposed team actually built. Always include original vs. final contract value and scheduled vs. actual completion; evaluators will call the references, so warn them first and confirm their contact info is current.',
            'body'    => <<<'HTML'
<h4>Summary of Relevant Projects</h4>
<table>
<thead>
<tr><th>Project / location</th><th>Owner</th><th>Delivery method</th><th>Size (SF)</th><th>Contract value (original / final)</th><th>Completion (scheduled / actual)</th><th>Team members involved</th></tr>
</thead>
<tbody>
<tr><td>[Project name — City, ST]</td><td>[Owner]</td><td>[CMAR GMP]</td><td>[SF]</td><td>$[amount] / $[amount]</td><td>[MM/YYYY] / [MM/YYYY]</td><td>[PM, Super]</td></tr>
<tr><td>[Project name — City, ST]</td><td>[Owner]</td><td>[Lump sum]</td><td>[SF]</td><td>$[amount] / $[amount]</td><td>[MM/YYYY] / [MM/YYYY]</td><td>[PX, PM]</td></tr>
<tr><td>[Project name — City, ST]</td><td>[Owner]</td><td>[Design-Build]</td><td>[SF]</td><td>$[amount] / $[amount]</td><td>[MM/YYYY] / [MM/YYYY]</td><td>[Super]</td></tr>
<tr><td>[Project name — City, ST]</td><td>[Owner]</td><td>[CMAR GMP]</td><td>[SF]</td><td>$[amount] / $[amount]</td><td>[MM/YYYY] / [MM/YYYY]</td><td>[PX, Super]</td></tr>
<tr><td>[Project name — City, ST]</td><td>[Owner]</td><td>[Lump sum]</td><td>[SF]</td><td>$[amount] / $[amount]</td><td>[MM/YYYY] / [MM/YYYY]</td><td>[PM]</td></tr>
</tbody>
</table>
<h4>Project Profile (repeat for each featured project)</h4>
<p><strong>[Project name]</strong> — [City, ST]<br>
<strong>Owner:</strong> [Owner name]<br>
<strong>Architect:</strong> [Firm name]<br>
<strong>Delivery method:</strong> [CM at-Risk / GC lump sum / Design-Build]<br>
<strong>Size:</strong> [SF], [number] stories<br>
<strong>Construction cost:</strong> $[amount]<br>
<strong>Completed:</strong> [Month, Year]<br>
<strong>Owner reference:</strong> [Name, title, phone, email]</p>
<p><strong>Scope:</strong> [Two to three sentences describing the work — new construction, renovation, occupied phasing, specialty systems.]</p>
<p><strong>Relevance to {{project_name}}:</strong> [Why this project matters — similar building type, same owner type, occupied site, similar budget, similar schedule constraint.]</p>
<p><strong>Results:</strong> [Documented outcomes only — e.g., completed [X] days early, $[X] returned from GMP savings, [X] change orders totaling [X]% of contract, [X] hours worked without a lost-time injury.]</p>
<p>[Insert one or two photos per project, with captions.]</p>
HTML,
        ],
        [
            'heading' => 'Preconstruction Services Approach',
            'tip'     => 'For CM at-risk selection this is where you differentiate; for pure GC prequalification, keep it brief or retitle as "Project Approach." Be concrete: what estimates you deliver at which design milestones, how you reconcile with the architect\'s estimate, how you run constructability and VE reviews, and how and when the GMP is built. Show a sample deliverable (estimate summary, VE log) in the appendix.',
            'body'    => <<<'HTML'
<p>Our preconstruction goal for {{project_name}} is simple: no surprises at GMP. We achieve it by estimating early and often, involving trade partners in design, and keeping a live, shared record of every budget decision.</p>
<h4>Preconstruction Deliverables by Design Phase</h4>
<table>
<thead>
<tr><th>Design milestone</th><th>Estimate type</th><th>Other deliverables</th></tr>
</thead>
<tbody>
<tr><td>Programming / Concept</td><td>Conceptual estimate ($/SF, parametric, historical)</td><td>Budget validation, preliminary master schedule, site logistics concept</td></tr>
<tr><td>Schematic Design</td><td>SD estimate by CSI division / systems (UniFormat)</td><td>Constructability review, VE options log, long-lead item list</td></tr>
<tr><td>Design Development</td><td>DD estimate — detailed quantity takeoff</td><td>Estimate reconciliation with architect's estimator, updated CPM schedule, MEP coordination strategy</td></tr>
<tr><td>50% Construction Documents</td><td>CD estimate — detailed, with trade input</td><td>Early bid / release packages, subcontractor outreach, MWBE plan</td></tr>
<tr><td>90–100% CDs</td><td>GMP estimate</td><td>GMP proposal with assumptions, clarifications, allowances, contingency, and schedule</td></tr>
</tbody>
</table>
<h4>How We Control Cost During Design</h4>
<ul>
<li><strong>Target value design:</strong> [Describe how you set targets by system and report variance at each milestone]</li>
<li><strong>Value engineering log:</strong> every idea tracked with cost, schedule, and lifecycle impact, and accepted or rejected by the owner and architect — never silently designed out</li>
<li><strong>Constructability reviews:</strong> formal reviews at [SD, DD, 50% CD, 95% CD] by the superintendent, MEP coordinator, and key trade partners</li>
<li><strong>Market and escalation tracking:</strong> monthly updates on [material pricing, lead times, labor availability] in [region]</li>
<li><strong>Early procurement:</strong> identify and release long-lead packages (e.g., [switchgear, generators, structural steel, elevators, AHUs]) ahead of full GMP where schedule demands</li>
<li><strong>BIM / VDC:</strong> [Clash detection with Navisworks / trade coordination models / LOD requirement] — [scope as applicable]</li>
</ul>
<h4>GMP Development</h4>
<p>We will develop the GMP with open books: subcontractor bids, our self-perform estimates, general conditions, contingency, and fee will all be visible to {{client_name}}. Trade packages will be competitively bid to a minimum of [three] prequalified subcontractors each, and bid results will be reviewed jointly with the owner before award.</p>
HTML,
        ],
        [
            'heading' => 'Project Management & Schedule Approach',
            'tip'     => 'Owners want evidence you can plan and control time. A one-page preliminary milestone schedule is persuasive even at RFQ stage; name your scheduling tool (e.g., Primavera P6, Microsoft Project) and whether you use pull planning or Last Planner. Address how you will manage RFIs, submittals, change orders, and quality.',
            'body'    => <<<'HTML'
<h4>Preliminary Milestone Schedule</h4>
<table>
<thead>
<tr><th>Milestone</th><th>Target date</th></tr>
</thead>
<tbody>
<tr><td>CM / GC selection and preconstruction start</td><td>[MM/YYYY]</td></tr>
<tr><td>Design Development complete / DD estimate</td><td>[MM/YYYY]</td></tr>
<tr><td>Early release package (site work / foundations)</td><td>[MM/YYYY]</td></tr>
<tr><td>GMP / contract execution</td><td>[MM/YYYY]</td></tr>
<tr><td>Notice to proceed / mobilization</td><td>[MM/YYYY]</td></tr>
<tr><td>Building dried in</td><td>[MM/YYYY]</td></tr>
<tr><td>Permanent power</td><td>[MM/YYYY]</td></tr>
<tr><td>Substantial completion</td><td>[MM/YYYY]</td></tr>
<tr><td>Owner occupancy / FF&amp;E move-in</td><td>[MM/YYYY]</td></tr>
<tr><td>Final completion and closeout</td><td>[MM/YYYY]</td></tr>
</tbody>
</table>
<h4>Project Controls</h4>
<ul>
<li><strong>Scheduling:</strong> CPM schedule in [Primavera P6 / MS Project], updated [monthly] with a narrative; three-week look-aheads built with trade foremen in weekly pull-planning sessions</li>
<li><strong>Cost reporting:</strong> monthly cost report showing committed costs, contingency log, allowance reconciliation, and forecast to complete</li>
<li><strong>Document control:</strong> RFIs, submittals, and change events managed in [Procore / other platform] with owner and design team access</li>
<li><strong>Quality control:</strong> written QC plan with preparatory, initial, and follow-up inspections for each definable feature of work; mock-ups for [envelope, curtain wall, finishes]</li>
<li><strong>Communication:</strong> weekly OAC meetings, monthly executive reports, and a single point of contact at {{firm_name}} for {{client_name}}</li>
<li><strong>Commissioning:</strong> coordinate with the owner's commissioning agent from design through [functional testing / seasonal testing]</li>
</ul>
HTML,
        ],
        [
            'heading' => 'MWBE / DBE / Small Business Participation Plan',
            'tip'     => 'Public owners often score good-faith effort as heavily as the percentage itself. Show your historical achievement with actual numbers, name the outreach steps (advertising, outreach events, breaking packages into smaller scopes, assistance with bonding and insurance, prompt pay), and commit to reporting. Do not list specific subcontractors you have not contacted.',
            'body'    => <<<'HTML'
<p>{{firm_name}} is committed to meeting or exceeding {{client_name}}'s [X]% [MWBE / DBE / SBE / HUB] participation goal for {{project_name}}.</p>
<h4>Historical Participation</h4>
<table>
<thead>
<tr><th>Project</th><th>Contract value</th><th>Goal</th><th>Achieved (% / $)</th></tr>
</thead>
<tbody>
<tr><td>[Project name]</td><td>$[amount]</td><td>[X]%</td><td>[X]% / $[amount]</td></tr>
<tr><td>[Project name]</td><td>$[amount]</td><td>[X]%</td><td>[X]% / $[amount]</td></tr>
<tr><td>[Project name]</td><td>$[amount]</td><td>[X]%</td><td>[X]% / $[amount]</td></tr>
</tbody>
</table>
<h4>Outreach and Inclusion Strategy</h4>
<ul>
<li>Advertise bid packages with [local chambers, certified-firm directories, trade associations] at least [X] days before bid</li>
<li>Host [a pre-bid outreach event / one-on-one meet-the-builder sessions] in [location]</li>
<li>Structure bid packages so smaller firms can compete (e.g., separating [scope] into supply and install)</li>
<li>Offer assistance with [bonding, insurance, and prequalification paperwork / mentor-protégé support]</li>
<li>Pay subcontractors within [X] days of receipt of owner payment; [joint check / expedited payment options for small firms]</li>
<li>Track and report participation [monthly] on {{client_name}}'s required forms</li>
</ul>
<p>Our diversity and inclusion program is led by [Name, title], who will be {{client_name}}'s point of contact for participation reporting.</p>
HTML,
        ],
        [
            'heading' => 'Insurance, Licensing & Legal Disclosures',
            'tip'     => 'This mirrors the "Legal" and "Experience" questions in AIA A305 and ConsensusDocs 721. Answer every question — a blank reads as evasion. Litigation disclosure is often pass/fail; describe any claims factually and briefly. Attach a sample certificate of insurance or a broker letter confirming you can meet the limits in the draft contract.',
            'body'    => <<<'HTML'
<h4>Insurance</h4>
<table>
<thead>
<tr><th>Coverage</th><th>Carrier</th><th>Limits (per occurrence / aggregate)</th></tr>
</thead>
<tbody>
<tr><td>Commercial General Liability</td><td>[Carrier]</td><td>$[1,000,000] / $[2,000,000]</td></tr>
<tr><td>Automobile Liability</td><td>[Carrier]</td><td>$[1,000,000] combined single limit</td></tr>
<tr><td>Umbrella / Excess Liability</td><td>[Carrier]</td><td>$[amount]</td></tr>
<tr><td>Workers' Compensation / Employer's Liability</td><td>[Carrier]</td><td>Statutory / $[1,000,000]</td></tr>
<tr><td>Contractor's Pollution Liability</td><td>[Carrier]</td><td>$[amount]</td></tr>
<tr><td>Builder's Risk</td><td>[Carrier or "provided by owner"]</td><td>[Replacement value of work]</td></tr>
<tr><td>Professional Liability (design-build / preconstruction)</td><td>[Carrier]</td><td>$[amount]</td></tr>
</tbody>
</table>
<p>Insurance broker: [Agency, contact, phone, email]. {{firm_name}} can name {{client_name}} and [architect] as additional insureds on a primary and non-contributory basis.</p>
<h4>Licenses</h4>
<p>{{license_number}} — [State, license class, expiration]. [List additional states or specialty licenses as applicable.]</p>
<h4>Legal Disclosures (past [5 / 10] years)</h4>
<table>
<thead>
<tr><th>Question</th><th>Response</th></tr>
</thead>
<tbody>
<tr><td>Has the firm been debarred, suspended, or declared ineligible by any public agency?</td><td>[No / explain]</td></tr>
<tr><td>Has the firm failed to complete any contract or had a contract terminated for cause?</td><td>[No / explain]</td></tr>
<tr><td>Pending or resolved litigation or arbitration arising from construction contracts</td><td>[None / list case, parties, amount, status]</td></tr>
<tr><td>Liquidated damages assessed</td><td>[None / explain]</td></tr>
<tr><td>Any officer or principal convicted of a crime related to contracting</td><td>[No]</td></tr>
<tr><td>OSHA willful or repeat violations</td><td>[None / explain]</td></tr>
<tr><td>Prevailing wage violations</td><td>[None / explain]</td></tr>
</tbody>
</table>
HTML,
        ],
        [
            'heading' => 'References',
            'tip'     => 'Provide owner references first, then architects and a surety or bank reference if requested. Use people who were directly involved and are still reachable. Call every reference before you submit so they expect the call and remember the right project.',
            'body'    => <<<'HTML'
<table>
<thead>
<tr><th>Reference name / title</th><th>Organization</th><th>Relationship / project</th><th>Phone</th><th>Email</th></tr>
</thead>
<tbody>
<tr><td>[Name, Title]</td><td>[Owner organization]</td><td>Owner — [Project name, year]</td><td>[Phone]</td><td>[Email]</td></tr>
<tr><td>[Name, Title]</td><td>[Owner organization]</td><td>Owner — [Project name, year]</td><td>[Phone]</td><td>[Email]</td></tr>
<tr><td>[Name, Title]</td><td>[Owner organization]</td><td>Owner — [Project name, year]</td><td>[Phone]</td><td>[Email]</td></tr>
<tr><td>[Name, AIA]</td><td>[Architecture firm]</td><td>Architect — [Project name, year]</td><td>[Phone]</td><td>[Email]</td></tr>
<tr><td>[Name]</td><td>{{surety_name}}</td><td>Surety</td><td>[Phone]</td><td>[Email]</td></tr>
<tr><td>[Name]</td><td>[Bank]</td><td>Bank</td><td>[Phone]</td><td>[Email]</td></tr>
</tbody>
</table>
HTML,
        ],
        [
            'heading' => 'Compliance Matrix / Requirements Cross-Reference',
            'tip'     => 'Mirror the RFQ\'s section numbers and wording exactly, and arrange your whole submittal in the same order — evaluators score with a checklist and will not hunt for answers. Respect page limits (know what counts: tabs, resumes, and appendices are often excluded, but not always). Many owners also require their own prequalification form or AIA A305 filled in; list it here too.',
            'body'    => <<<'HTML'
<p>The following table cross-references each requirement of {{solicitation_number}} to its location in this submittal.</p>
<table>
<thead>
<tr><th>RFQ section</th><th>Requirement</th><th>Response location (tab / page)</th><th>Complies (Y/N)</th></tr>
</thead>
<tbody>
<tr><td>[X.1]</td><td>Cover letter signed by authorized officer</td><td>[Tab 1, p. X]</td><td>[Y]</td></tr>
<tr><td>[X.2]</td><td>Firm information / AIA A305 or owner prequalification form</td><td>[Tab 2, p. X]</td><td>[Y]</td></tr>
<tr><td>[X.3]</td><td>Safety record — EMR letter, OSHA 300A (3 years)</td><td>[Tab 4 / Appendix X]</td><td>[Y]</td></tr>
<tr><td>[X.4]</td><td>Surety letter — single and aggregate capacity</td><td>[Tab 5 / Appendix X]</td><td>[Y]</td></tr>
<tr><td>[X.5]</td><td>Financial statements (audited / reviewed, 3 years)</td><td>[Sealed envelope / Appendix X]</td><td>[Y]</td></tr>
<tr><td>[X.6]</td><td>Key personnel and resumes</td><td>[Tab 7 / Appendix X]</td><td>[Y]</td></tr>
<tr><td>[X.7]</td><td>Relevant project experience ([number] projects in [number] years)</td><td>[Tab 8, p. X]</td><td>[Y]</td></tr>
<tr><td>[X.8]</td><td>Preconstruction approach</td><td>[Tab 9, p. X]</td><td>[Y]</td></tr>
<tr><td>[X.9]</td><td>MWBE / DBE participation plan</td><td>[Tab 11, p. X]</td><td>[Y]</td></tr>
<tr><td>[X.10]</td><td>Insurance certificate / broker letter</td><td>[Tab 12 / Appendix X]</td><td>[Y]</td></tr>
<tr><td>[X.11]</td><td>Litigation and claims disclosure</td><td>[Tab 12, p. X]</td><td>[Y]</td></tr>
<tr><td>[X.12]</td><td>References</td><td>[Tab 13, p. X]</td><td>[Y]</td></tr>
<tr><td>[X.13]</td><td>Required forms — non-collusion, debarment, E-Verify, conflict of interest</td><td>[Appendix X]</td><td>[Y]</td></tr>
<tr><td>[X.14]</td><td>Addenda acknowledgment</td><td>[Tab 1 / Form X]</td><td>[Y]</td></tr>
</tbody>
</table>
<p><strong>Exceptions or deviations:</strong> [None / list any requirement you cannot meet and your proposed alternative.]</p>
HTML,
        ],
        [
            'heading' => 'Appendices & Required Forms',
            'tip'     => 'Put the bulky evidence here so the narrative stays readable. Label each appendix to match the compliance matrix. Double-check signatures, notarizations, and dates — an unsigned affidavit can disqualify an otherwise strong submittal on a public project.',
            'body'    => <<<'HTML'
<ol>
<li>Appendix A — AIA A305 Contractor's Qualification Statement / [owner prequalification form], completed and signed</li>
<li>Appendix B — Full resumes of key personnel</li>
<li>Appendix C — EMR letter from insurance carrier ([3] years) and OSHA 300A summaries ([3] years)</li>
<li>Appendix D — Written safety program (table of contents) and sample site-specific safety plan</li>
<li>Appendix E — Surety letter from {{surety_name}}</li>
<li>Appendix F — Financial statements ([audited / reviewed], [3] years) [or: submitted under separate sealed cover]</li>
<li>Appendix G — Bank reference letter</li>
<li>Appendix H — Sample certificate of insurance / broker letter</li>
<li>Appendix I — Contractor license(s) and business registration</li>
<li>Appendix J — MWBE / DBE certifications and historical participation reports</li>
<li>Appendix K — Sample preconstruction deliverables (estimate summary, VE log, CPM schedule excerpt)</li>
<li>Appendix L — Owner-required affidavits and forms: [non-collusion, debarment certification, drug-free workplace, E-Verify, conflict of interest, addenda acknowledgment]</li>
</ol>
<p>Submitted by {{firm_name}} — {{contact_name}}, {{contact_title}} — {{firm_phone}} — {{firm_email}}</p>
HTML,
        ],
    ],
];
