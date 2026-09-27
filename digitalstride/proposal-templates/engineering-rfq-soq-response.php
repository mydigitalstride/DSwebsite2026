<?php
if (!defined('ABSPATH')) exit;

return [
    'slug'     => 'engineering-rfq-soq-response',
    'title'    => 'Engineering RFQ / SOQ & Technical Proposal Response',
    'industry' => 'engineering',
    'type'     => 'rfp',
    'summary'  => 'A complete Statement of Qualifications and technical proposal for public-agency engineering solicitations — municipal, state DOT, or federal (SF 330). Built for civil, structural, and MEP firms, with a technical approach, task-based work plan, QA/QC plan, DBE participation plan, and compliance matrix.',
    'use_when' => [
        'Responding to a city, county, utility district, or school district RFQ/RFP for engineering design services',
        'Submitting a qualifications-based selection (QBS) package to a state DOT for a task order or project-specific contract',
        'Preparing the narrative content that feeds a federal SF 330 (Part I Sections E, F, G, and H)',
        'Pursuing an on-call / IDIQ engineering services contract where qualifications and approach are scored before fee',
        'Teaming as prime with survey, geotechnical, environmental, or specialty subconsultants and a DBE goal',
    ],
    'length'   => '15–40 pages plus resumes and forms (follow the solicitation page limit)',

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
        'project_manager'     => 'Proposed project manager (name, PE)',
        'principal_in_charge' => 'Principal-in-charge (name, PE)',
        'qaqc_manager'        => 'QA/QC manager (name, PE)',
    ],

    'checklist' => [
        'Every section heading and number mirrors the solicitation\'s evaluation criteria and submittal instructions, in the same order',
        'Page count is within the stated limit — confirm what counts (cover, tabs, resumes, forms) and font/margin minimums',
        'Compliance matrix is complete and every "page reference" points to the correct final page after layout',
        'All addenda are acknowledged on the agency\'s form and listed in the cover letter',
        'Key personnel named in the org chart, resumes, and labor commitment table are identical (names, titles, license numbers)',
        'PE/SE licenses for the project manager, EOR(s), and QA/QC reviewer are current in the project state; firm Certificate of Authorization / COA number included if required',
        'Subconsultant commitment letters are signed and the DBE/SBE participation percentages add up and match the agency\'s DBE forms',
        'DBE certifications verified in the state Unified Certification Program (UCP) directory for the correct NAICS/work codes',
        'Project experience examples are within the look-back window (commonly 5–10 years) and include a reference whose contact information has been verified',
        'SF 330 Part I and Part II completed (federal) or state DOT prequalification / consultant forms attached, signed, and dated',
        'Conflict of interest, non-collusion, debarment/suspension, lobbying (for federal funds), and E-Verify certifications signed by an authorized officer',
        'No fee or rate information included if the procurement is QBS — fee goes in a separate sealed envelope only when requested',
        'Insurance certificate or statement of ability to meet required limits (professional liability, general liability, auto, workers\' comp) included',
        'Proposed schedule respects the agency\'s milestones and review durations stated in the RFQ',
        'Proofread for other agencies\' names, old project names, and "[bracket]" placeholders left from this template',
        'Delivery method confirmed (portal upload, hard copies, USB) with required number of copies and file naming; submitted before the deadline with a confirmation receipt',
    ],

    'sections' => [
        [
            'heading' => 'Cover Letter / Letter of Interest',
            'tip'     => 'Keep it to one or two pages, signed by an officer authorized to bind the firm (many agencies require this and will disqualify otherwise). State the solicitation number, acknowledge every addendum by number, name the project manager and point of contact, and give two or three reasons you are the right team that tie directly to the owner\'s stated goals. Do not open with firm history.',
            'body'    => <<<'HTML'
<p>{{submittal_date}}</p>
<p>{{client_contact}}<br>{{client_name}}<br>[Agency street address]<br>[City, ST ZIP]</p>
<p><strong>Re: {{solicitation_number}} — Statement of Qualifications for {{project_name}}</strong></p>
<p>Dear {{client_contact}}:</p>
<p>{{firm_name}} is pleased to submit our Statement of Qualifications to provide [civil / structural / mechanical-electrical-plumbing / multidisciplinary] engineering services for {{project_name}} in {{project_location}}. We have read the solicitation in full and acknowledge receipt of Addenda [No. 1 dated MM/DD/YYYY, No. 2 dated MM/DD/YYYY].</p>
<p>We understand that {{client_name}}'s priorities for this project are [priority 1 — e.g., maintaining traffic and access to adjacent businesses during construction], [priority 2 — e.g., delivering a biddable design within the $[amount] construction budget], and [priority 3 — e.g., meeting the [funding source] obligation deadline of [date]]. Our team is organized around those priorities:</p>
<ul>
<li><strong>Relevant, recent experience.</strong> We have completed [number] similar projects in the last [number] years, including [Project name — City, ST — year completed — construction cost $], delivered for [owner name].</li>
<li><strong>A project manager who will be there.</strong> {{project_manager}} will lead this project from kickoff through construction phase services and is committed at [percent]% availability. [He/She/They] recently managed [similar project] for [owner].</li>
<li><strong>A proven approach to your key risk.</strong> [One sentence on how your approach addresses the project's biggest technical or schedule risk — e.g., early utility potholing to avoid conflicts that commonly cause change orders on corridor projects.]</li>
</ul>
<p>Our team includes [Subconsultant name] for [survey / geotechnical / environmental / traffic / landscape], [Subconsultant name] for [discipline], and [Subconsultant name] for [discipline]. Together our team commits to [number]% DBE participation against the stated goal of [number]%.</p>
<p>{{project_manager}} will serve as your day-to-day contact and can be reached at [PM phone] and [PM email]. For contractual matters, please contact me at {{firm_phone}} or {{firm_email}}. I am authorized to bind {{firm_name}} and confirm that this submittal remains valid for [90/120] days from the due date.</p>
<p>Sincerely,</p>
<p>[Signature]<br>{{contact_name}}, [PE]<br>{{contact_title}}<br>{{firm_name}}<br>{{firm_address}}<br>{{firm_website}}</p>
HTML,
        ],
        [
            'heading' => 'Table of Contents',
            'tip'     => 'Use the agency\'s own section numbers and titles (e.g., "Criterion 3.2 — Technical Approach") so evaluators can score with their checklist beside your document. Update page numbers after final layout — mismatched page references are one of the most common and most avoidable errors.',
            'body'    => <<<'HTML'
<table>
<thead><tr><th>RFQ Section</th><th>Response Section</th><th>Page</th></tr></thead>
<tbody>
<tr><td>[e.g., 4.1]</td><td>Cover Letter / Letter of Interest</td><td>[#]</td></tr>
<tr><td>[4.2]</td><td>Firm Overview and Qualifications</td><td>[#]</td></tr>
<tr><td>[4.3]</td><td>Project Understanding</td><td>[#]</td></tr>
<tr><td>[4.4]</td><td>Technical Approach</td><td>[#]</td></tr>
<tr><td>[4.5]</td><td>Work Plan and Scope by Task</td><td>[#]</td></tr>
<tr><td>[4.6]</td><td>Project Team, Organization Chart, and Key Personnel</td><td>[#]</td></tr>
<tr><td>[4.7]</td><td>Relevant Project Experience</td><td>[#]</td></tr>
<tr><td>[4.8]</td><td>Schedule and Capacity</td><td>[#]</td></tr>
<tr><td>[4.9]</td><td>Quality Assurance / Quality Control Plan</td><td>[#]</td></tr>
<tr><td>[4.10]</td><td>DBE / SBE Participation Plan</td><td>[#]</td></tr>
<tr><td>[4.11]</td><td>References</td><td>[#]</td></tr>
<tr><td>[4.12]</td><td>Compliance Matrix</td><td>[#]</td></tr>
<tr><td>[Appendix]</td><td>Resumes, Required Forms, Certifications, SF 330 (if federal)</td><td>[#]</td></tr>
</tbody>
</table>
HTML,
        ],
        [
            'heading' => 'Firm Overview and Qualifications',
            'tip'     => 'Evaluators want the facts that reduce their risk: licensure in the state, office proximity, size of the discipline staff who would actually do the work, and prior work for this agency or similar agencies. Skip generic mission statements. If the RFQ asks for prequalification categories (common with state DOTs), list them exactly as the DOT names them.',
            'body'    => <<<'HTML'
<p>{{firm_name}} is a [number]-person [civil / structural / MEP / multidisciplinary] engineering firm founded in [year] and headquartered at {{firm_address}}. This project will be led from our [City, ST] office, located [number] miles from {{project_location}}, where [number] engineers, designers, and technicians work, including [number] licensed Professional Engineers[ and [number] licensed Structural Engineers].</p>
<table>
<thead><tr><th>Item</th><th>Detail</th></tr></thead>
<tbody>
<tr><td>Legal name and entity type</td><td>{{firm_name}} — [Corporation / LLC / Partnership], organized in [State]</td></tr>
<tr><td>Years in business</td><td>[Number] years</td></tr>
<tr><td>Firm registration / Certificate of Authorization</td><td>{{license_number}}</td></tr>
<tr><td>Unique Entity ID (SAM.gov) — federal only</td><td>[UEI]</td></tr>
<tr><td>State DOT prequalification</td><td>[Category / work type codes, e.g., Roadway Design, Bridge Design, Traffic Signal Design] — expires [date]</td></tr>
<tr><td>Disciplines in-house</td><td>[e.g., Roadway, drainage/stormwater, water/wastewater, structural, mechanical, electrical, plumbing, fire protection, survey]</td></tr>
<tr><td>Staff available for this project</td><td>[Number] PEs, [number] EITs, [number] CAD/BIM technicians, [number] inspectors</td></tr>
<tr><td>Prior work for {{client_name}}</td><td>[Number] projects since [year] — or "None; similar agencies include [list]"</td></tr>
<tr><td>Small business / DBE status of prime</td><td>[Certified DBE/SBE/MBE/WBE — certifying agency — or "Not applicable"]</td></tr>
</tbody>
</table>
<h4>Relevant Services</h4>
<ul>
<li>[Planning, alternatives analysis, and preliminary engineering / feasibility studies]</li>
<li>[Final design and construction documents — plans, specifications, and estimates (PS&amp;E)]</li>
<li>[Permitting — NPDES/SWPPP, USACE Section 404, state environmental, DOT encroachment, utility and railroad agreements]</li>
<li>[Bid-phase services and construction phase services — RFIs, submittals, site observation, record drawings]</li>
<li>[Discipline-specific: e.g., building structural assessment and seismic retrofit / MEP system condition assessment and energy code compliance / hydraulic modeling]</li>
</ul>
HTML,
        ],
        [
            'heading' => 'Project Understanding',
            'tip'     => 'This is where you prove you have read the RFQ, visited the site, and understand what the owner is worried about. Name specific site conditions, constraints, and stakeholders. Strong responses identify two to four issues the RFQ did not spell out — that is what separates a shortlisted firm from the pack.',
            'body'    => <<<'HTML'
<p>{{client_name}} is seeking engineering services to [plain-language description of the project — e.g., reconstruct [number] linear feet of [Street Name] between [cross street] and [cross street], including roadway, storm sewer, water main replacement, ADA curb ramps, and signal upgrades / design the structural and MEP systems for a [number]-square-foot [building type] / rehabilitate the [structure name] built in [year]]. The project is funded by [local CIP / state grant / federal-aid (FHWA/FTA/FAA/EPA SRF) / bond program], with an estimated construction budget of $[amount] and a target bid date of [month year].</p>
<h4>Existing Conditions We Observed</h4>
<p>Our team visited the site on [date]. Key observations include:</p>
<ul>
<li>[Observation 1 — e.g., pavement shows alligator cracking and base failure, suggesting full-depth reconstruction rather than mill and overlay in the [segment] segment]</li>
<li>[Observation 2 — e.g., the existing [size]-inch [material] water main dates to [year]; utility records show [number] breaks since [year]]</li>
<li>[Observation 3 — e.g., existing mechanical equipment is past its expected service life and the electrical service appears undersized for the planned load]</li>
<li>[Observation 4 — e.g., visible spalling and exposed reinforcing at [location] indicate chloride-induced corrosion]</li>
</ul>
<h4>Critical Issues and How We Will Address Them</h4>
<table>
<thead><tr><th>Issue</th><th>Why It Matters</th><th>Our Approach</th></tr></thead>
<tbody>
<tr><td>[Utility conflicts — e.g., franchise fiber and gas in the corridor]</td><td>[Unresolved conflicts are a leading cause of construction delay and change orders]</td><td>[SUE Quality Level B designation and targeted QL-A test holes at [number] locations before 60% plans]</td></tr>
<tr><td>[Stakeholder / access — e.g., businesses, schools, emergency services]</td><td>[Council and public concern about access during construction]</td><td>[Phasing plan and maintenance-of-traffic concept developed at 30%, reviewed with stakeholders]</td></tr>
<tr><td>[Permitting / environmental]</td><td>[Permit lead times of [number] months could drive the schedule]</td><td>[Early agency coordination meeting in Month [#]; permit applications submitted with 60% plans]</td></tr>
<tr><td>[Budget risk]</td><td>[Current bid climate / escalation]</td><td>[Engineer's opinion of probable construction cost at each milestone, with value engineering options at 30%]</td></tr>
</tbody>
</table>
HTML,
        ],
        [
            'heading' => 'Technical Approach',
            'tip'     => 'Technical approach is usually the highest-weighted criterion (often 25–40% of the score). Be specific to this project: design criteria and standards you will apply, analysis methods and software, and how you will make key decisions. Show alternatives you will evaluate and the criteria for choosing among them. Avoid boilerplate that could be pasted into any proposal.',
            'body'    => <<<'HTML'
<p>Our technical approach is built around [one-sentence project philosophy — e.g., "resolving the major unknowns before 30% so that later design phases refine rather than redesign"]. The discussion below is organized by discipline; we will tailor each element to {{client_name}}'s standards and the direction you give us at kickoff.</p>
<h4>Design Criteria and Standards</h4>
<ul>
<li>Civil: {{client_name}} Standard Details and Specifications; [State] DOT Standard Specifications ([edition]); AASHTO Green Book; MUTCD ([edition]); PROWAG/ADA; local stormwater manual and [NPDES MS4] permit requirements [edit list for your discipline]</li>
<li>[Structural: [IBC edition] as adopted by [jurisdiction]; ASCE 7-[edition]; ACI 318; AISC 360; AASHTO LRFD Bridge Design Specifications for bridge elements]</li>
<li>[MEP: [IBC/IMC/IPC/NEC editions] as adopted; ASHRAE 62.1 and 90.1 (or IECC [edition]); NFPA 13/72 where applicable; owner design standards]</li>
</ul>
<h4>Data Collection and Investigations</h4>
<p>We will begin with [topographic and boundary survey tied to [State Plane / project datum], subsurface utility engineering to ASCE 38 Quality Level [B/A], geotechnical borings at [number] locations with pavement cores, and a records search of as-builts and utility maps]. For building projects, we will [perform a field survey of existing conditions, verify structural members and connections, and document existing MEP equipment nameplate data].</p>
<h4>Analysis and Design</h4>
<ul>
<li>[Roadway/geometric: alignment, profile, and cross-section design in [Civil 3D / OpenRoads]; turning movements checked for [design vehicle]]</li>
<li>[Drainage: hydrologic and hydraulic analysis using [Rational Method / TR-55 / HEC-HMS / StormCAD / HEC-RAS] for the [number]-year design storm; water quality treatment per [standard]]</li>
<li>[Utilities: water main hydraulic modeling in [software]; sanitary sewer capacity and condition review from CCTV]</li>
<li>[Structural: gravity and lateral system analysis in [software]; foundation design coordinated with geotechnical recommendations; evaluation of [retrofit / new construction] alternatives]</li>
<li>[MEP: load calculations; equipment selection and life-cycle cost comparison of [number] system alternatives; lighting and power design; energy code compliance documentation]</li>
</ul>
<h4>Alternatives and Value Engineering</h4>
<p>At the 30% milestone we will present [number] alternatives for [key decision — e.g., pavement section, pipe material, structural framing system, HVAC system type], compared on construction cost, life-cycle cost, constructability, schedule, and maintenance preference. We will recommend a preferred alternative and document {{client_name}}'s decision in a design memorandum.</p>
<h4>Constructability and Cost Control</h4>
<p>[Describe constructability reviews, phasing and maintenance-of-traffic, bid item structure, and the engineer's opinion of probable construction cost (OPCC) prepared at 30%, 60%, 90%, and final, with contingency percentages appropriate to each stage.]</p>
<h4>CAD / BIM and Deliverable Standards</h4>
<p>Plans will be prepared in [AutoCAD Civil 3D / MicroStation OpenRoads / Revit] in accordance with {{client_name}}'s CAD standards[ and [State] DOT CADD manual]. [For building projects: Revit models developed to LOD [300/350] at construction documents, with clash detection between disciplines before 90%.] Specifications will follow [CSI MasterFormat / owner standard specifications with special provisions].</p>
HTML,
        ],
        [
            'heading' => 'Work Plan and Scope by Task',
            'tip'     => 'Break the work into numbered tasks that match how the owner will contract and invoice. Each task should state what you will do, what you need from the owner, and the deliverable. Evaluators check that nothing in the RFQ scope is missing — use the RFQ\'s own task list if it provides one.',
            'body'    => <<<'HTML'
<p>Our work plan is organized into the following tasks. Task numbering will carry through to our fee proposal, schedule, and monthly invoices so progress is easy to track.</p>
<table>
<thead><tr><th>Task</th><th>Activities</th><th>Deliverables</th></tr></thead>
<tbody>
<tr><td>1. Project Management and Coordination</td><td>Kickoff meeting; monthly progress reports and invoices; biweekly coordination calls; subconsultant management; schedule updates; decision log</td><td>Kickoff minutes, project management plan, monthly reports</td></tr>
<tr><td>2. Data Collection</td><td>Records research, topographic survey, SUE, geotechnical investigation, site visits, existing conditions documentation</td><td>Base mapping, geotechnical report, existing conditions memo</td></tr>
<tr><td>3. Preliminary Design (30%)</td><td>Alternatives analysis, design criteria, preliminary plans, OPCC, utility coordination letters</td><td>30% plans, design memorandum, OPCC</td></tr>
<tr><td>4. Design Development (60%)</td><td>Refined design, drainage/structural/MEP calculations, draft specifications outline, permit applications</td><td>60% plans, calculations, OPCC, permit submittals</td></tr>
<tr><td>5. Pre-Final Design (90%)</td><td>Complete plans and technical specifications, constructability review, final utility coordination</td><td>90% PS&amp;E, updated OPCC</td></tr>
<tr><td>6. Final Design (100%)</td><td>Address 90% comments, sealed documents, bid tabulation form</td><td>Signed and sealed plans, specifications, final OPCC, comment resolution log</td></tr>
<tr><td>7. Permitting and Agency Coordination</td><td>[NPDES/SWPPP, USACE, state DOT, railroad, utility, building department]</td><td>Permit applications and approvals</td></tr>
<tr><td>8. Public Involvement [if required]</td><td>[Public meetings, stakeholder briefings, exhibits]</td><td>[Meeting materials and summaries]</td></tr>
<tr><td>9. Bid-Phase Services</td><td>Pre-bid meeting, responses to bidder questions, addenda, bid review and recommendation</td><td>Addenda, bid tabulation, recommendation of award</td></tr>
<tr><td>10. Construction Phase Services</td><td>Preconstruction meeting, RFIs, submittal review, site visits, change order review, punch list, record drawings</td><td>RFI/submittal logs, field reports, record drawings</td></tr>
</tbody>
</table>
<h4>Owner-Furnished Information and Reviews</h4>
<p>We have assumed {{client_name}} will provide [as-built drawings, GIS data, prior studies, standard specifications, and access to the site], and will complete milestone reviews within [number] business days. We will lead a review comment resolution meeting at each milestone.</p>
HTML,
        ],
        [
            'heading' => 'Project Team, Organization Chart, and Key Personnel',
            'tip'     => 'Agencies score the people, not the firm. Show a clear org chart with the owner at the top, one PM as the single point of contact, and discipline leads with license numbers. Include a labor commitment table — evaluators check availability, and substituting key staff after award usually requires written owner approval. Resumes typically go in an appendix limited to one or two pages each (SF 330 Section E for federal).',
            'body'    => <<<'HTML'
<p>Our team is organized so that {{client_name}} has one point of contact — {{project_manager}} — supported by experienced discipline leads who have worked together on [number] prior projects.</p>
<p><strong>Organization chart (describe in text if graphics are not allowed):</strong></p>
<ul>
<li>{{client_name}} — {{client_contact}}, Project Manager</li>
<li>Principal-in-Charge: {{principal_in_charge}}</li>
<li>Project Manager: {{project_manager}}</li>
<li>QA/QC Manager (independent of design team): {{qaqc_manager}}</li>
<li>Discipline Leads: [Name, PE — Roadway], [Name, PE — Drainage/Stormwater], [Name, PE/SE — Structural], [Name, PE — Mechanical], [Name, PE — Electrical], [Name, PE — Plumbing/Fire Protection]</li>
<li>Subconsultants: [Firm — Survey (PLS)], [Firm — Geotechnical], [Firm — Environmental], [Firm — DBE specialty]</li>
</ul>
<h4>Key Personnel</h4>
<table>
<thead><tr><th>Name / Role</th><th>License(s)</th><th>Years (Total / With Firm)</th><th>Relevant Experience</th><th>Availability</th></tr></thead>
<tbody>
<tr><td>{{principal_in_charge}} — Principal-in-Charge</td><td>[PE, State, No.]</td><td>[##] / [##]</td><td>[Two similar projects with owner names]</td><td>[##]%</td></tr>
<tr><td>{{project_manager}} — Project Manager</td><td>[PE, State, No.]</td><td>[##] / [##]</td><td>[Two similar projects with owner names]</td><td>[##]%</td></tr>
<tr><td>{{qaqc_manager}} — QA/QC Manager</td><td>[PE, State, No.]</td><td>[##] / [##]</td><td>[QA/QC role on similar projects]</td><td>[##]%</td></tr>
<tr><td>[Name, PE/SE — Discipline Lead]</td><td>[License]</td><td>[##] / [##]</td><td>[Experience]</td><td>[##]%</td></tr>
<tr><td>[Name, PLS — Survey Lead (Subconsultant)]</td><td>[PLS, State, No.]</td><td>[##] / [##]</td><td>[Experience]</td><td>[##]%</td></tr>
<tr><td>[Name, PE — Geotechnical Lead (Subconsultant)]</td><td>[License]</td><td>[##] / [##]</td><td>[Experience]</td><td>[##]%</td></tr>
</tbody>
</table>
<p>{{firm_name}} commits that the key personnel named above will remain on the project for its duration. Any substitution will be proposed in writing with a candidate of equal or greater qualifications and made only with {{client_name}}'s approval.</p>
HTML,
        ],
        [
            'heading' => 'Relevant Project Experience',
            'tip'     => 'Choose three to five projects most similar in type, size, owner, and funding source — recency matters (many RFQs limit to the last 5–10 years). For each, name which proposed team members worked on it and in what role; evaluators discount firm experience delivered by people who are no longer on the team. Include outcomes you can verify: on-schedule delivery, bid versus estimate, change order rate.',
            'body'    => <<<'HTML'
<p>The following projects demonstrate our team's experience with work of similar scope, complexity, and funding requirements. Each was performed by staff proposed for {{project_name}}.</p>
<h4>Project 1: [Project name — City, ST]</h4>
<table>
<tbody>
<tr><th>Owner / Reference</th><td>[Agency name — contact name, title, phone, email]</td></tr>
<tr><th>Services provided</th><td>[e.g., Preliminary and final design, permitting, bid and construction phase services]</td></tr>
<tr><th>Dates</th><td>[Design: MM/YYYY–MM/YYYY; Construction completed: MM/YYYY]</td></tr>
<tr><th>Construction cost</th><td>[Engineer's estimate $ / Low bid $ / Final cost $]</td></tr>
<tr><th>Proposed team members involved</th><td>{{project_manager}} (Project Manager); [Name (Role)]</td></tr>
<tr><th>Funding</th><td>[Local / state / federal-aid]</td></tr>
</tbody>
</table>
<p>[Two to four sentences describing the project scope, key challenges, and how they were solved. End with a measurable outcome — e.g., "Bids came in [number]% below the engineer's estimate and construction closed with change orders totaling [number]% of the contract."]</p>
<p><strong>Relevance to {{project_name}}:</strong> [One sentence linking this project to the current one.]</p>
<h4>Project 2: [Project name — City, ST]</h4>
<table>
<tbody>
<tr><th>Owner / Reference</th><td>[Agency name — contact name, title, phone, email]</td></tr>
<tr><th>Services provided</th><td>[Services]</td></tr>
<tr><th>Dates</th><td>[Dates]</td></tr>
<tr><th>Construction cost</th><td>[$]</td></tr>
<tr><th>Proposed team members involved</th><td>[Names and roles]</td></tr>
<tr><th>Funding</th><td>[Funding]</td></tr>
</tbody>
</table>
<p>[Project description and outcome.]</p>
<p><strong>Relevance to {{project_name}}:</strong> [One sentence.]</p>
<h4>Project 3: [Project name — City, ST]</h4>
<table>
<tbody>
<tr><th>Owner / Reference</th><td>[Agency name — contact name, title, phone, email]</td></tr>
<tr><th>Services provided</th><td>[Services]</td></tr>
<tr><th>Dates</th><td>[Dates]</td></tr>
<tr><th>Construction cost</th><td>[$]</td></tr>
<tr><th>Proposed team members involved</th><td>[Names and roles]</td></tr>
<tr><th>Funding</th><td>[Funding]</td></tr>
</tbody>
</table>
<p>[Project description and outcome.]</p>
<p><strong>Relevance to {{project_name}}:</strong> [One sentence.]</p>
<h4>Experience Summary Matrix</h4>
<table>
<thead><tr><th>Project</th><th>[Criterion A — e.g., Federal-aid]</th><th>[Criterion B — e.g., Water main]</th><th>[Criterion C — e.g., Occupied facility]</th><th>[Criterion D — e.g., Same owner]</th></tr></thead>
<tbody>
<tr><td>[Project 1]</td><td>[Yes/No]</td><td>[Yes/No]</td><td>[Yes/No]</td><td>[Yes/No]</td></tr>
<tr><td>[Project 2]</td><td>[Yes/No]</td><td>[Yes/No]</td><td>[Yes/No]</td><td>[Yes/No]</td></tr>
<tr><td>[Project 3]</td><td>[Yes/No]</td><td>[Yes/No]</td><td>[Yes/No]</td><td>[Yes/No]</td></tr>
</tbody>
</table>
HTML,
        ],
        [
            'heading' => 'Schedule and Capacity',
            'tip'     => 'Show a milestone schedule that honors every date in the RFQ and includes realistic owner review periods (commonly two to four weeks per milestone) and permit lead times. Back up capacity claims with current workload numbers — evaluators on public selection panels often ask about this in interviews. A Gantt chart can be attached as an exhibit if graphics count toward the page limit.',
            'body'    => <<<'HTML'
<p>The schedule below assumes Notice to Proceed on [date] and is built around {{client_name}}'s target [bid date / funding obligation date] of [date].</p>
<table>
<thead><tr><th>Milestone</th><th>Duration</th><th>Target Date</th></tr></thead>
<tbody>
<tr><td>Notice to Proceed / Kickoff Meeting</td><td>—</td><td>[MM/DD/YYYY]</td></tr>
<tr><td>Survey, SUE, and Geotechnical Complete</td><td>[#] weeks</td><td>[MM/DD/YYYY]</td></tr>
<tr><td>30% Submittal</td><td>[#] weeks</td><td>[MM/DD/YYYY]</td></tr>
<tr><td>Owner Review of 30%</td><td>[#] weeks</td><td>[MM/DD/YYYY]</td></tr>
<tr><td>60% Submittal and Permit Applications</td><td>[#] weeks</td><td>[MM/DD/YYYY]</td></tr>
<tr><td>Owner Review of 60%</td><td>[#] weeks</td><td>[MM/DD/YYYY]</td></tr>
<tr><td>90% Submittal (PS&amp;E)</td><td>[#] weeks</td><td>[MM/DD/YYYY]</td></tr>
<tr><td>Owner Review of 90%</td><td>[#] weeks</td><td>[MM/DD/YYYY]</td></tr>
<tr><td>100% Sealed Documents</td><td>[#] weeks</td><td>[MM/DD/YYYY]</td></tr>
<tr><td>Permits Received</td><td>—</td><td>[MM/DD/YYYY]</td></tr>
<tr><td>Advertise for Bids</td><td>—</td><td>[MM/DD/YYYY]</td></tr>
<tr><td>Construction Phase Services</td><td>[#] months</td><td>[MM/YYYY–MM/YYYY]</td></tr>
</tbody>
</table>
<h4>Schedule Control</h4>
<p>{{project_manager}} will update the schedule monthly and report progress against each milestone in our monthly status report. If a milestone is at risk, we will notify {{client_name}} in writing within [number] business days with the cause and a recovery plan.</p>
<h4>Current Workload and Capacity</h4>
<table>
<thead><tr><th>Key Person</th><th>Current Commitments</th><th>% Committed Through [Date]</th><th>% Available for This Project</th></tr></thead>
<tbody>
<tr><td>{{project_manager}}</td><td>[Projects and expected completion]</td><td>[##]%</td><td>[##]%</td></tr>
<tr><td>[Discipline lead]</td><td>[Projects]</td><td>[##]%</td><td>[##]%</td></tr>
<tr><td>[Discipline lead]</td><td>[Projects]</td><td>[##]%</td><td>[##]%</td></tr>
</tbody>
</table>
HTML,
        ],
        [
            'heading' => 'Quality Assurance / Quality Control Plan',
            'tip'     => 'Generic QA/QC language scores poorly. Name the independent reviewer (not on the design team), define what is checked at each milestone, and describe how comments are documented and closed. Many DOTs require a project-specific QC plan as a deliverable within 30 days of NTP — say you will provide one. Mention constructability and biddability reviews; owners care most about fewer RFIs and change orders.',
            'body'    => <<<'HTML'
<p>{{firm_name}}'s Quality Management System [is documented in our corporate QA/QC Manual / is certified to ISO 9001:[year] — use only if true]. For {{project_name}}, we will prepare a project-specific Quality Control Plan within [number] days of Notice to Proceed that identifies reviewers, review checklists, and documentation procedures.</p>
<h4>Roles</h4>
<ul>
<li><strong>QA/QC Manager — {{qaqc_manager}}:</strong> A senior engineer who is not part of the day-to-day design team. Assigns reviewers, verifies that reviews are complete before each submittal, and signs the QC certification.</li>
<li><strong>Discipline Checkers:</strong> Licensed engineers independent of the originator who check calculations and drawings for their discipline.</li>
<li><strong>Project Manager — {{project_manager}}:</strong> Responsible for scheduling reviews, confirming comments are resolved, and coordinating interdisciplinary checks.</li>
</ul>
<h4>Review Activities by Milestone</h4>
<table>
<thead><tr><th>Milestone</th><th>Review Type</th><th>Focus</th><th>Documentation</th></tr></thead>
<tbody>
<tr><td>Design criteria / 30%</td><td>Concept and criteria review</td><td>Design criteria, alternatives, fatal flaws, budget alignment</td><td>Signed review checklist, design memo</td></tr>
<tr><td>60%</td><td>Discipline check and interdisciplinary coordination</td><td>Calculations checked; conflicts between civil, structural, MEP, and utilities</td><td>Redline set, calculation check prints, clash report</td></tr>
<tr><td>90%</td><td>Constructability and biddability review</td><td>Sequencing, maintenance of traffic, bid item quantities, plan-spec consistency</td><td>Constructability checklist, quantity check</td></tr>
<tr><td>100%</td><td>Final QC and back-check</td><td>All comments closed, seals and signatures, specification completeness</td><td>Comment resolution log, QC certification</td></tr>
</tbody>
</table>
<h4>Comment Resolution</h4>
<p>Every internal and owner review comment will be logged with the reviewer, response, and action taken, and verified closed by the originator and checker. The comment resolution log will be included with each submittal to {{client_name}}.</p>
<h4>Subconsultant Quality</h4>
<p>Subconsultant deliverables (survey, geotechnical, environmental) will be reviewed by the responsible {{firm_name}} discipline lead before incorporation, and subconsultants will follow the same checklist and documentation procedures.</p>
HTML,
        ],
        [
            'heading' => 'DBE / SBE Participation Plan',
            'tip'     => 'For federal-aid projects (49 CFR Part 26) the DBE goal and good-faith-efforts rules are strict — count only firms certified in the state UCP for the specific work they will perform, and meet or document good faith efforts toward the goal. Show real, meaningful scopes for DBE firms rather than token assignments; evaluators notice. Match percentages to the agency\'s required DBE forms exactly.',
            'body'    => <<<'HTML'
<p>{{firm_name}} is committed to meaningful participation by Disadvantaged Business Enterprises on {{project_name}}. The solicitation establishes a [DBE / SBE / MBE / WBE] goal of [number]%. Our team commits to [number]% participation through the firms below, each performing a commercially useful function within its certified work codes.</p>
<table>
<thead><tr><th>Firm</th><th>Certification (Type / Agency / No.)</th><th>Work Code / NAICS</th><th>Scope of Work</th><th>Estimated % of Contract</th></tr></thead>
<tbody>
<tr><td>[DBE firm name]</td><td>[DBE — [State] UCP — No. ####]</td><td>[e.g., 541370 Surveying]</td><td>[Topographic survey, right-of-way mapping]</td><td>[##]%</td></tr>
<tr><td>[DBE firm name]</td><td>[DBE — [State] UCP — No. ####]</td><td>[e.g., 541380 Testing Laboratories]</td><td>[Geotechnical borings and laboratory testing]</td><td>[##]%</td></tr>
<tr><td>[DBE firm name]</td><td>[Certification]</td><td>[Code]</td><td>[Scope]</td><td>[##]%</td></tr>
<tr><td><strong>Total committed participation</strong></td><td></td><td></td><td></td><td><strong>[##]%</strong></td></tr>
</tbody>
</table>
<h4>Good Faith Efforts and Monitoring</h4>
<ul>
<li>We [solicited proposals from [number] certified firms through the [State] UCP directory and outreach on [dates] / met the goal without need for good faith efforts documentation].</li>
<li>We will report DBE payments [monthly / with each invoice] on {{client_name}}'s required forms and pay subconsultants within [number] days of receiving payment, consistent with prompt payment requirements.</li>
<li>Any DBE substitution will be requested in writing and made only with {{client_name}}'s prior approval, following the agency's termination and substitution procedures.</li>
</ul>
<p>[Attach signed DBE commitment / letter of intent forms and certification letters as required by the solicitation.]</p>
HTML,
        ],
        [
            'heading' => 'References',
            'tip'     => 'Call every reference before listing them — confirm their phone and email still work and that they remember the project favorably. Public-agency references carry the most weight for public work. Use different references than the ones already named in project sheets only if the RFQ asks for additional references.',
            'body'    => <<<'HTML'
<table>
<thead><tr><th>Client / Agency</th><th>Contact Name and Title</th><th>Phone / Email</th><th>Project(s) and Year</th><th>Our Role</th></tr></thead>
<tbody>
<tr><td>[Agency name]</td><td>[Name, title]</td><td>[Phone] / [Email]</td><td>[Project — year]</td><td>[Prime — design and CPS]</td></tr>
<tr><td>[Agency name]</td><td>[Name, title]</td><td>[Phone] / [Email]</td><td>[Project — year]</td><td>[Role]</td></tr>
<tr><td>[Agency name]</td><td>[Name, title]</td><td>[Phone] / [Email]</td><td>[Project — year]</td><td>[Role]</td></tr>
</tbody>
</table>
HTML,
        ],
        [
            'heading' => 'Required Forms, Certifications, and Disclosures',
            'tip'     => 'Missing or unsigned forms are the most common reason a technically strong submittal is rejected as non-responsive. For federal work, SF 330 Part I is the project-specific form and Part II is the firm-level form (one per office that will perform work). If the procurement is QBS, never include fee or rates in the qualifications package.',
            'body'    => <<<'HTML'
<p>The following forms and certifications are included in [Appendix X] as required by {{solicitation_number}}:</p>
<ul>
<li>[Agency submittal form / signature page, signed by an authorized officer]</li>
<li>[Acknowledgment of Addenda No. [#] through [#]]</li>
<li>[SF 330 Part I (project-specific) and Part II for each office performing work — federal procurements]</li>
<li>[State DOT consultant forms / prequalification certificate]</li>
<li>Professional engineering firm registration / Certificate of Authorization: {{license_number}}</li>
<li>[Conflict of Interest / Organizational Conflict of Interest disclosure]</li>
<li>[Certification regarding Debarment, Suspension, and Other Responsibility Matters]</li>
<li>[Certification regarding Lobbying and Disclosure of Lobbying Activities (SF-LLL) — federal funds over the applicable threshold]</li>
<li>[Non-collusion affidavit; drug-free workplace; E-Verify; Iran/boycott or other state-mandated certifications]</li>
<li>[DBE commitment forms and certification letters]</li>
<li>[Insurance certificate or letter from broker confirming required limits]</li>
<li>[W-9]</li>
</ul>
<h4>Conflict of Interest Statement</h4>
<p>{{firm_name}} [has no known conflicts of interest / discloses the following relationships: [describe]] with respect to {{project_name}}, {{client_name}}, or parties likely to bid on construction. [If applicable: We will not participate as a contractor or subcontractor on the construction contract for this project.]</p>
<h4>Insurance</h4>
<p>{{firm_name}} currently carries, and will maintain for the duration of the contract, the following coverage: Professional Liability $[amount] per claim / $[amount] aggregate; Commercial General Liability $[amount] per occurrence / $[amount] aggregate; Automobile Liability $[amount]; Workers' Compensation at statutory limits; [Umbrella $[amount]].</p>
HTML,
        ],
        [
            'heading' => 'Compliance Matrix',
            'tip'     => 'Build this first and fill in page references last. List every "shall," "must," and submittal requirement in the RFQ with the section number, and every evaluation criterion with its weight — this is the evaluator\'s scoring map. Mirror the solicitation\'s exact numbering and wording, and double-check page limits, font size, and file-size limits for portal uploads.',
            'body'    => <<<'HTML'
<table>
<thead><tr><th>RFQ Section</th><th>Requirement</th><th>Evaluation Weight</th><th>Response Location (Section / Page)</th><th>Complies</th></tr></thead>
<tbody>
<tr><td>[x.x]</td><td>[Letter of interest signed by authorized officer]</td><td>[Pass/Fail]</td><td>[Cover Letter / p. #]</td><td>[Yes]</td></tr>
<tr><td>[x.x]</td><td>[Firm qualifications and experience]</td><td>[##] points</td><td>[Section / p. #]</td><td>[Yes]</td></tr>
<tr><td>[x.x]</td><td>[Project understanding and technical approach]</td><td>[##] points</td><td>[Section / p. #]</td><td>[Yes]</td></tr>
<tr><td>[x.x]</td><td>[Qualifications of key personnel and PE licensure in [State]]</td><td>[##] points</td><td>[Section / p. #]</td><td>[Yes]</td></tr>
<tr><td>[x.x]</td><td>[Relevant experience within last [#] years]</td><td>[##] points</td><td>[Section / p. #]</td><td>[Yes]</td></tr>
<tr><td>[x.x]</td><td>[Schedule and capacity to perform]</td><td>[##] points</td><td>[Section / p. #]</td><td>[Yes]</td></tr>
<tr><td>[x.x]</td><td>[QA/QC plan]</td><td>[##] points</td><td>[Section / p. #]</td><td>[Yes]</td></tr>
<tr><td>[x.x]</td><td>[DBE participation meeting goal of [#]%]</td><td>[Pass/Fail or ## points]</td><td>[Section / p. #]</td><td>[Yes]</td></tr>
<tr><td>[x.x]</td><td>[Local presence / office location]</td><td>[##] points</td><td>[Section / p. #]</td><td>[Yes]</td></tr>
<tr><td>[x.x]</td><td>[References — minimum of [#]]</td><td>[##] points</td><td>[Section / p. #]</td><td>[Yes]</td></tr>
<tr><td>[x.x]</td><td>[Page limit of [#] pages; [size]-point font minimum]</td><td>[Pass/Fail]</td><td>[Entire submittal]</td><td>[Yes]</td></tr>
<tr><td>[x.x]</td><td>[Required forms and certifications]</td><td>[Pass/Fail]</td><td>[Appendix / p. #]</td><td>[Yes]</td></tr>
<tr><td>[x.x]</td><td>[Addenda acknowledged]</td><td>[Pass/Fail]</td><td>[Cover Letter; Appendix / p. #]</td><td>[Yes]</td></tr>
</tbody>
</table>
<h4>Exceptions and Clarifications</h4>
<p>{{firm_name}} [takes no exceptions to the solicitation or the sample agreement / requests the following clarifications to the sample agreement, to be discussed during negotiation]:</p>
<ul>
<li>[e.g., Limit the indemnity clause to the extent caused by our negligence, consistent with [State] statute]</li>
<li>[e.g., Clarify that the standard of care is that of a similarly situated professional]</li>
</ul>
<p><em>Delete this list if you take no exceptions.</em></p>
HTML,
        ],
        [
            'heading' => 'Appendix: Resumes and SF 330 Crosswalk',
            'tip'     => 'Keep resumes tailored to this project: lead with the three to five most relevant projects and the person\'s specific role. For federal submittals, SF 330 Section E resumes, Section F project examples (up to ten), Section G participation matrix, and Section H narrative map directly to the sections above — reuse the content rather than rewriting it.',
            'body'    => <<<'HTML'
<h4>Resume Format (one page per person)</h4>
<p><strong>[Name, PE/SE/PLS] — [Role on this project]</strong><br>
Firm: {{firm_name}} [or subconsultant name] | Office: [City, ST]<br>
Education: [Degree, Discipline, University, Year]<br>
Registration: [PE — State(s), No., expiration]; [other certifications — e.g., PTOE, CFM, LEED AP, ENV SP, CPESC]<br>
Years of experience: [##] total / [##] with current firm</p>
<p><strong>Relevant Experience</strong></p>
<ul>
<li>[Project name, Owner, City, ST (year)] — [Role]. [One or two sentences on scope and this person's specific contribution.]</li>
<li>[Project name, Owner, City, ST (year)] — [Role]. [Scope and contribution.]</li>
<li>[Project name, Owner, City, ST (year)] — [Role]. [Scope and contribution.]</li>
</ul>
<h4>SF 330 Crosswalk (Federal Submittals)</h4>
<table>
<thead><tr><th>SF 330 Part I Section</th><th>Content</th><th>Source in This Template</th></tr></thead>
<tbody>
<tr><td>A–B</td><td>Contract information and architect-engineer point of contact</td><td>Cover Letter</td></tr>
<tr><td>C</td><td>Proposed team (prime and subconsultants, office locations, roles)</td><td>Project Team; DBE Plan</td></tr>
<tr><td>D</td><td>Organizational chart of proposed team</td><td>Project Team</td></tr>
<tr><td>E</td><td>Resumes of key personnel</td><td>This appendix</td></tr>
<tr><td>F</td><td>Example projects that best illustrate team qualifications</td><td>Relevant Project Experience</td></tr>
<tr><td>G</td><td>Key personnel participation in example projects</td><td>Relevant Project Experience; Key Personnel</td></tr>
<tr><td>H</td><td>Additional information (approach, QA/QC, capacity, past performance)</td><td>Project Understanding; Technical Approach; Work Plan; Schedule; QA/QC</td></tr>
<tr><td>I</td><td>Authorized representative signature</td><td>Cover Letter signatory — {{contact_name}}, {{contact_title}}</td></tr>
</tbody>
</table>
HTML,
        ],
    ],
];
