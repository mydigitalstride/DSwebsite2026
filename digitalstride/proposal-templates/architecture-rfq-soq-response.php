<?php
if (!defined('ABSPATH')) exit;

return [
    'slug'     => 'architecture-rfq-soq-response',
    'title'    => 'Architecture RFQ Response: Statement of Qualifications (SOQ)',
    'industry' => 'architecture',
    'type'     => 'rfp',
    'summary'  => 'A complete Statement of Qualifications for public and institutional owners selecting an architect through qualifications-based selection (QBS). It covers the transmittal letter, compliance matrix, project understanding, team, resumes, project sheets, approach, QA/QC, capacity, DBE participation, and references, with SF 330 cross-reference notes for federal work.',
    'use_when' => [
        'A city, county, school district, university, or state agency has issued an RFQ for architectural services',
        'The owner selects on qualifications first (QBS) and negotiates fee only with the top-ranked firm',
        'A federal agency requests an SF 330. Use this as your drafting outline, then transfer the content into Parts I and II',
        'You are responding to an on-call or IDIQ architectural services solicitation',
        'You need to refresh your standard qualifications package before a shortlist interview',
    ],
    'length'   => '20–40 pages (or the page limit in the RFQ)',

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
        'principal_in_charge' => 'Principal-in-charge name',
        'project_manager'     => 'Project manager / project architect name',
    ],

    'checklist' => [
        'Every requirement in the RFQ appears in the compliance matrix with a page reference, and the section numbering mirrors the RFQ',
        'Page count, font size, margins, and tab/divider rules match the RFQ exactly (check whether resumes, forms, and covers count toward the limit)',
        'All addenda have been downloaded, read, and acknowledged on the required form',
        'No fee, hourly rates, or cost information is included (unless the RFQ explicitly asks for it in a separate sealed envelope)',
        'Transmittal letter is signed by a principal authorized to bind the firm, and names a single point of contact',
        'Every person on the org chart has a resume, and every resume lists the specific role on this project',
        'Architect registration numbers (and the state of registration) are current for the principal and project architect; firm is registered with the state board where required',
        'Project sheets show owner, completion year, construction cost, delivery method, and which proposed team members actually worked on each one',
        'Owner references have been called in advance, agreed to be contacted, and their phone numbers and emails are verified',
        'Subconsultant (MEP, structural, civil, landscape, specialty) letters of commitment and resumes are included',
        'DBE/MBE/WBE participation percentages match the utilization form and the certification letters attached',
        'Certificate of insurance or insurer letter shows professional liability (E&O) and general liability limits at or above the RFQ minimums',
        'Required forms are completed and signed: non-collusion, conflict of interest, debarment, W-9, drug-free workplace, or local equivalents',
        'For federal work: SF 330 Part I and one Part II per firm (prime and each subconsultant office) are complete, and Section H does not exceed page limits',
        'Photos are credited and approved for use, and renderings of unbuilt work are clearly labeled',
        'Delivery method confirmed: number of hard copies, USB/electronic copy, portal upload size limits, and deadline time zone',
        'A final read by someone who did not write it, checking owner name, project name, and solicitation number on every page',
    ],

    'sections' => [
        [
            'heading' => 'Transmittal Letter',
            'tip'     => 'Keep it to one page and sign it as a principal who can bind the firm. Evaluators skim this for three things: that you understand what they are building, who they will work with day to day, and that you acknowledged all addenda. Do not open with firm history; open with their project.',
            'body'    => <<<'HTML'
<p>{{submittal_date}}</p>
<p>{{client_contact}}<br>{{client_name}}<br>[Owner mailing address]</p>
<p><strong>Re: Statement of Qualifications for Architectural Services, {{project_name}}, RFQ No. {{solicitation_number}}</strong></p>
<p>Dear {{client_contact}},</p>
<p>{{firm_name}} is pleased to submit our qualifications to provide architectural and engineering design services for {{project_name}} in {{project_location}}. We understand that {{client_name}} needs [one-sentence summary of the owner's goal, e.g. "a 60,000 SF middle school that replaces two aging campuses, opens for the fall term of (year), and stays within a bond-funded construction budget of $(amount)"].</p>
<p>We have assembled a team that has done this exact kind of work together. Our proposed Principal-in-Charge, {{principal_in_charge}}, and Project Manager, {{project_manager}}, have delivered [number] [building type] projects for public owners over the past [number] years, including [most relevant project name — owner — year completed]. Our consultant team includes [MEP engineer firm], [structural engineer firm], [civil engineer firm], and [landscape architect or specialty consultant], each of whom has worked with us on [number] prior projects.</p>
<p>Three things set our team apart for this project:</p>
<ul>
<li><strong>[Differentiator 1 tied to the owner's goal]</strong> — [one sentence of proof, e.g. a comparable project delivered on budget].</li>
<li><strong>[Differentiator 2]</strong> — [one sentence of proof].</li>
<li><strong>[Differentiator 3]</strong> — [one sentence of proof].</li>
</ul>
<p>We acknowledge receipt of Addenda [numbers, e.g. 1 through 3]. {{firm_name}} is registered to practice architecture in [state] (Firm Registration No. {{license_number}}), and our submission remains valid for [number] days from the submittal date.</p>
<p>{{project_manager}} will be your day-to-day contact and can be reached at {{firm_phone}} or {{firm_email}}. I am authorized to bind {{firm_name}} and look forward to discussing our qualifications with the selection committee.</p>
<p>Sincerely,</p>
<p>[Signature]<br>{{contact_name}}, [AIA / credentials]<br>{{contact_title}}<br>{{firm_name}}<br>{{firm_address}}<br>{{firm_website}}</p>
HTML,
        ],
        [
            'heading' => 'Compliance Matrix and Requirements Cross-Reference',
            'tip'     => 'Mirror the RFQ\'s own section numbers and wording so a reviewer can check off each requirement without hunting. Most RFQs publish scoring criteria and weights; organize your whole SOQ in that same order. For federal work, add an SF 330 column mapping each item to Part I Sections A–I and Part II, since evaluators score directly from those sections.',
            'body'    => <<<'HTML'
<p>The table below maps every submittal requirement in RFQ No. {{solicitation_number}} to its location in this Statement of Qualifications.</p>
<table>
<thead>
<tr><th>RFQ Section</th><th>Requirement</th><th>Evaluation Weight</th><th>SOQ Section / Page</th><th>SF 330 Reference (federal only)</th></tr>
</thead>
<tbody>
<tr><td>[e.g. 4.1]</td><td>Transmittal letter signed by an authorized officer</td><td>[Pass/fail]</td><td>Transmittal Letter, p. [#]</td><td>Part I, Section D (signature)</td></tr>
<tr><td>[4.2]</td><td>Firm information, history, and licensure</td><td>[% or points]</td><td>Firm Profile, p. [#]</td><td>Part I, Section B; Part II</td></tr>
<tr><td>[4.3]</td><td>Project understanding and approach</td><td>[% or points]</td><td>Project Understanding; Approach, p. [#]</td><td>Part I, Section H</td></tr>
<tr><td>[4.4]</td><td>Proposed team and organization chart</td><td>[% or points]</td><td>Project Team, p. [#]</td><td>Part I, Sections C and D</td></tr>
<tr><td>[4.5]</td><td>Resumes of key personnel</td><td>[% or points]</td><td>Key Personnel Resumes, p. [#]</td><td>Part I, Section E</td></tr>
<tr><td>[4.6]</td><td>Relevant project experience (minimum [number] projects)</td><td>[% or points]</td><td>Project Experience, p. [#]</td><td>Part I, Sections F and G</td></tr>
<tr><td>[4.7]</td><td>Quality control program</td><td>[% or points]</td><td>QA/QC, p. [#]</td><td>Part I, Section H</td></tr>
<tr><td>[4.8]</td><td>Current workload and capacity</td><td>[% or points]</td><td>Workload and Capacity, p. [#]</td><td>Part I, Section H; Part II, Block 9</td></tr>
<tr><td>[4.9]</td><td>DBE/MBE/WBE participation</td><td>[% or points]</td><td>Participation Plan, p. [#]</td><td>Part I, Section C (small business status)</td></tr>
<tr><td>[4.10]</td><td>References</td><td>[% or points]</td><td>References, p. [#]</td><td>Part I, Section F (owner contact)</td></tr>
<tr><td>[4.11]</td><td>Insurance and required forms</td><td>[Pass/fail]</td><td>Appendix, p. [#]</td><td>N/A</td></tr>
<tr><td>[Addenda]</td><td>Acknowledgment of Addenda [numbers]</td><td>[Pass/fail]</td><td>Appendix, p. [#]</td><td>N/A</td></tr>
</tbody>
</table>
HTML,
        ],
        [
            'heading' => 'Project Understanding',
            'tip'     => 'This is where most SOQs lose points by restating the RFQ back to the owner. Show that you did homework: visited the site, read the facilities master plan or bond language, and understand the real constraints (occupied campus, tight site, historic review, funding deadlines). Name two or three specific issues and how you would handle them.',
            'body'    => <<<'HTML'
<p>{{client_name}} is planning {{project_name}}, a [new construction / renovation / addition] of approximately [gross square feet] SF at {{project_location}}. Based on the RFQ, our review of [facilities master plan / bond program / feasibility study / board minutes], and our visit to the site on [date], we understand the project's goals to be:</p>
<ol>
<li><strong>[Goal 1, e.g. functional program]</strong> — [what the owner needs the building to do, in their language].</li>
<li><strong>[Goal 2, e.g. budget and funding]</strong> — a construction budget of approximately $[amount], funded by [bond / grant / appropriation], with [any funding deadline or restriction].</li>
<li><strong>[Goal 3, e.g. schedule]</strong> — occupancy by [month, year], which drives design completion by approximately [month, year].</li>
<li><strong>[Goal 4, e.g. sustainability or community]</strong> — [energy target, LEED/WELL goal, net-zero ready, community use].</li>
</ol>
<h4>Key Issues We See</h4>
<table>
<thead>
<tr><th>Issue</th><th>Why It Matters</th><th>How We Would Address It</th></tr>
</thead>
<tbody>
<tr><td>[e.g. Occupied site during construction]</td><td>[Safety, operations, phasing cost]</td><td>[e.g. Phasing plan developed in Schematic Design with the contractor or cost estimator; temporary separation and wayfinding]</td></tr>
<tr><td>[e.g. Existing building condition / code compliance]</td><td>[Unknown conditions drive change orders]</td><td>[e.g. Early existing-conditions survey, laser scan to Revit, selective destructive investigation]</td></tr>
<tr><td>[e.g. Authority having jurisdiction / historic review]</td><td>[Approval timeline risk]</td><td>[e.g. Pre-application meeting in first 30 days; code analysis at end of SD]</td></tr>
<tr><td>[e.g. Budget pressure from escalation]</td><td>[Scope reductions late in design]</td><td>[e.g. Independent estimates at SD, DD, and 95% CD; prioritized alternates list]</td></tr>
</tbody>
</table>
HTML,
        ],
        [
            'heading' => 'Firm Profile',
            'tip'     => 'Keep firm history short and relevant: years in practice, office that will do the work, staff by discipline, and the portion of your work in this building type. Evaluators care about the office and people on this project, not your firm-wide headcount. For federal work, this content maps to SF 330 Part II (one per office), including the profile codes and experience bands in Block 9.',
            'body'    => <<<'HTML'
<p>{{firm_name}} is a [legal structure, e.g. S corporation / LLP] founded in [year] and headquartered at {{firm_address}}. The work on {{project_name}} will be led from our [city] office, which is [distance] from the project site.</p>
<table>
<thead>
<tr><th>Firm Information</th><th>Detail</th></tr>
</thead>
<tbody>
<tr><td>Legal name</td><td>{{firm_name}}</td></tr>
<tr><td>Years in practice</td><td>[Number] years</td></tr>
<tr><td>Firm registration</td><td>[State] Firm Registration No. {{license_number}}</td></tr>
<tr><td>Office performing the work</td><td>[Address]</td></tr>
<tr><td>Total staff / staff in this office</td><td>[Number] / [Number]</td></tr>
<tr><td>Licensed architects</td><td>[Number]</td></tr>
<tr><td>LEED AP / WELL AP / CPHC or other credentials</td><td>[Number and type]</td></tr>
<tr><td>Small business / DBE / MBE / WBE status</td><td>[Certification and certifying agency, or "Not applicable"]</td></tr>
<tr><td>Principal contact</td><td>{{contact_name}}, {{contact_title}} — {{firm_phone}} — {{firm_email}}</td></tr>
</tbody>
</table>
<h4>Staff by Discipline (office performing the work)</h4>
<table>
<thead>
<tr><th>Discipline</th><th>Number of Staff</th></tr>
</thead>
<tbody>
<tr><td>Principals / Licensed Architects</td><td>[#]</td></tr>
<tr><td>Project Architects / Designers</td><td>[#]</td></tr>
<tr><td>Interior Designers</td><td>[#]</td></tr>
<tr><td>BIM / Technical Staff</td><td>[#]</td></tr>
<tr><td>Construction Administration</td><td>[#]</td></tr>
<tr><td>Administrative</td><td>[#]</td></tr>
</tbody>
</table>
<p>Over the past [number] years, [percentage]% of our work has been for [public / K-12 / higher education / civic / healthcare] clients, including [number] projects of similar size and complexity to {{project_name}}.</p>
HTML,
        ],
        [
            'heading' => 'Project Team and Organization Chart',
            'tip'     => 'Show every key person with a name, role, firm, and license, and draw clear lines of communication to the owner. Evaluators penalize "bait and switch," so commit that named key personnel will stay on the project. For federal work, this is SF 330 Section C (proposed team) and Section D (org chart).',
            'body'    => <<<'HTML'
<p>Our team is organized so that {{client_name}} has one point of contact, {{project_manager}}, who is supported by the same people from the first programming meeting through construction closeout. {{firm_name}} commits that the key personnel named below will remain on the project for its full duration and will not be substituted without the owner's written approval.</p>
<h4>Organization Chart</h4>
<p>[Insert graphic org chart: {{client_name}} at top → {{principal_in_charge}}, Principal-in-Charge → {{project_manager}}, Project Manager → Project Architect, Designer, Interior Designer, CA Administrator → Subconsultants (MEP, Structural, Civil, Landscape, Specialty). Show the owner's contact and any CM/GC if known.]</p>
<h4>Key Personnel</h4>
<table>
<thead>
<tr><th>Name and Credentials</th><th>Firm</th><th>Role on This Project</th><th>Years of Experience</th><th>% Time Committed</th></tr>
</thead>
<tbody>
<tr><td>{{principal_in_charge}}, [AIA, LEED AP]</td><td>{{firm_name}}</td><td>Principal-in-Charge</td><td>[#]</td><td>[#]%</td></tr>
<tr><td>{{project_manager}}, [AIA]</td><td>{{firm_name}}</td><td>Project Manager</td><td>[#]</td><td>[#]%</td></tr>
<tr><td>[Name, AIA]</td><td>{{firm_name}}</td><td>Project Architect / Technical Lead</td><td>[#]</td><td>[#]%</td></tr>
<tr><td>[Name]</td><td>{{firm_name}}</td><td>Lead Designer</td><td>[#]</td><td>[#]%</td></tr>
<tr><td>[Name, NCIDQ]</td><td>{{firm_name}}</td><td>Interior Designer</td><td>[#]</td><td>[#]%</td></tr>
<tr><td>[Name]</td><td>{{firm_name}}</td><td>Construction Administrator</td><td>[#]</td><td>[#]%</td></tr>
<tr><td>[Name, PE]</td><td>[MEP firm]</td><td>MEP / Fire Protection Engineer</td><td>[#]</td><td>[#]%</td></tr>
<tr><td>[Name, PE, SE]</td><td>[Structural firm]</td><td>Structural Engineer</td><td>[#]</td><td>[#]%</td></tr>
<tr><td>[Name, PE]</td><td>[Civil firm]</td><td>Civil Engineer</td><td>[#]</td><td>[#]%</td></tr>
<tr><td>[Name, PLA]</td><td>[Landscape firm]</td><td>Landscape Architect</td><td>[#]</td><td>[#]%</td></tr>
<tr><td>[Name]</td><td>[Firm]</td><td>[Specialty: cost estimating / acoustics / AV / food service / security]</td><td>[#]</td><td>[#]%</td></tr>
</tbody>
</table>
<h4>Team History</h4>
<p>Our core team has worked together on [number] projects, including [project name], [project name], and [project name]. [Subconsultant firm] and {{firm_name}} have collaborated for [number] years on [building type] work.</p>
HTML,
        ],
        [
            'heading' => 'Key Personnel Resumes',
            'tip'     => 'One page per person, tailored to this project. Lead each resume with the role on this project and the three to five most relevant projects, and state what the person actually did on each. For federal work, use SF 330 Section E format (one per person, maximum 10 projects each) and make sure any project listed in Section F that a person worked on is also shown on their resume.',
            'body'    => <<<'HTML'
<h4>{{principal_in_charge}}, [AIA, LEED AP BD+C] — Principal-in-Charge</h4>
<table>
<tbody>
<tr><td><strong>Role on this project</strong></td><td>[e.g. Contract authority, owner relationship, design quality oversight, attends all milestone reviews]</td></tr>
<tr><td><strong>Years of experience</strong></td><td>[#] total / [#] with {{firm_name}}</td></tr>
<tr><td><strong>Education</strong></td><td>[Degree, Institution, Year]</td></tr>
<tr><td><strong>Registration</strong></td><td>Registered Architect, [State] No. [number]; NCARB Certificate [yes/no]</td></tr>
<tr><td><strong>Other credentials</strong></td><td>[LEED AP, WELL AP, CSI CCS, etc.]</td></tr>
</tbody>
</table>
<p><strong>Relevant Experience</strong></p>
<ul>
<li><strong>[Project name], [Owner], [City, ST]</strong> — [SF], $[construction cost], completed [year]. Role: [Principal-in-Charge]. [One sentence on what this person did and the result.]</li>
<li><strong>[Project name], [Owner], [City, ST]</strong> — [SF], $[construction cost], completed [year]. Role: [role]. [Result.]</li>
<li><strong>[Project name], [Owner], [City, ST]</strong> — [SF], $[construction cost], completed [year]. Role: [role]. [Result.]</li>
</ul>
<h4>{{project_manager}}, [AIA] — Project Manager</h4>
<table>
<tbody>
<tr><td><strong>Role on this project</strong></td><td>[e.g. Day-to-day contact, schedule and budget management, leads owner and user-group meetings, coordinates consultants]</td></tr>
<tr><td><strong>Years of experience</strong></td><td>[#] total / [#] with {{firm_name}}</td></tr>
<tr><td><strong>Education</strong></td><td>[Degree, Institution, Year]</td></tr>
<tr><td><strong>Registration</strong></td><td>Registered Architect, [State] No. [number]</td></tr>
<tr><td><strong>Other credentials</strong></td><td>[Credentials]</td></tr>
</tbody>
</table>
<p><strong>Relevant Experience</strong></p>
<ul>
<li><strong>[Project name], [Owner], [City, ST]</strong> — [SF], $[construction cost], completed [year]. Role: [Project Manager]. [Result, e.g. "Delivered bid within [#]% of the SD estimate."]</li>
<li><strong>[Project name], [Owner], [City, ST]</strong> — [SF], $[construction cost], completed [year]. Role: [role]. [Result.]</li>
<li><strong>[Project name], [Owner], [City, ST]</strong> — [SF], $[construction cost], completed [year]. Role: [role]. [Result.]</li>
</ul>
<p>[Repeat this format for the Project Architect, Lead Designer, Interior Designer, Construction Administrator, and each subconsultant discipline lead.]</p>
HTML,
        ],
        [
            'heading' => 'Relevant Project Experience',
            'tip'     => 'Pick projects that match the owner type, building type, size, and delivery method, and that the proposed team actually worked on. Recent work (within 5–10 years) scores highest. Include cost and schedule outcomes (estimate vs. bid, original vs. final contract) because owners remember change orders. For federal work, this is SF 330 Section F (maximum 10 projects) and the Section G matrix of which personnel worked on which projects.',
            'body'    => <<<'HTML'
<p>The projects below were selected because they match {{project_name}} in [building type, size, owner type, and delivery method], and because the people proposed for {{client_name}} led them.</p>
<h4>Project 1: [Project Name]</h4>
<table>
<tbody>
<tr><td><strong>Owner</strong></td><td>[Owner name] — Reference: [Name, title, phone, email]</td></tr>
<tr><td><strong>Location</strong></td><td>[City, ST]</td></tr>
<tr><td><strong>Size / type</strong></td><td>[SF]; [new construction / renovation / addition]</td></tr>
<tr><td><strong>Construction cost</strong></td><td>Estimate at CD: $[amount] / Awarded bid or GMP: $[amount] / Final: $[amount]</td></tr>
<tr><td><strong>Delivery method</strong></td><td>[Design-bid-build / CM at-risk / design-build bridging]</td></tr>
<tr><td><strong>Completion</strong></td><td>[Month, year] ([on schedule / number of days early or late, and reason])</td></tr>
<tr><td><strong>Sustainability / recognition</strong></td><td>[LEED level, EUI target, award name and year, or "N/A"]</td></tr>
<tr><td><strong>Team members involved</strong></td><td>{{principal_in_charge}} (PIC), {{project_manager}} (PM), [others and subconsultants]</td></tr>
</tbody>
</table>
<p>[Three to five sentences: the owner's challenge, what our team did, and the measurable outcome. Tie it to an issue {{client_name}} faces, e.g. "Like {{project_name}}, this campus remained occupied through a four-phase construction sequence..."]</p>
<p>[Insert 1–2 photos with photographer credit.]</p>
<h4>Project 2: [Project Name]</h4>
<p>[Repeat the table and narrative format above.]</p>
<h4>Project 3: [Project Name]</h4>
<p>[Repeat the table and narrative format above.]</p>
<h4>Team Participation Matrix</h4>
<table>
<thead>
<tr><th>Team Member</th><th>Project 1</th><th>Project 2</th><th>Project 3</th><th>Project 4</th><th>Project 5</th></tr>
</thead>
<tbody>
<tr><td>{{principal_in_charge}}</td><td>[X]</td><td>[X]</td><td>[ ]</td><td>[X]</td><td>[ ]</td></tr>
<tr><td>{{project_manager}}</td><td>[X]</td><td>[ ]</td><td>[X]</td><td>[X]</td><td>[X]</td></tr>
<tr><td>[Project Architect]</td><td>[X]</td><td>[X]</td><td>[X]</td><td>[ ]</td><td>[X]</td></tr>
<tr><td>[MEP Engineer]</td><td>[X]</td><td>[X]</td><td>[ ]</td><td>[X]</td><td>[ ]</td></tr>
<tr><td>[Structural Engineer]</td><td>[ ]</td><td>[X]</td><td>[X]</td><td>[X]</td><td>[ ]</td></tr>
</tbody>
</table>
HTML,
        ],
        [
            'heading' => 'Project Approach and Methodology',
            'tip'     => 'Describe how you will run this project, phase by phase, in the owner\'s terms: how users are engaged, when decisions get locked, and where cost is checked. A simple milestone schedule showing the owner\'s review points is more convincing than a generic process diagram. Avoid committing to a fee or detailed hours here; that belongs in negotiation after selection.',
            'body'    => <<<'HTML'
<p>Our approach to {{project_name}} is built around [the owner's top priority, e.g. "holding the budget while giving users a real voice in the design"]. We organize the work in the standard phases of the AIA B101 agreement, with defined owner decisions at the end of each phase so that scope, cost, and schedule are confirmed before we move on.</p>
<table>
<thead>
<tr><th>Phase</th><th>Key Activities</th><th>Owner Decision / Deliverable</th><th>Approximate Duration</th></tr>
</thead>
<tbody>
<tr><td>Programming and Existing Conditions</td><td>User-group workshops, space program validation, site and existing building assessment, code and zoning analysis</td><td>Approved space program and project budget reconciliation</td><td>[#] weeks</td></tr>
<tr><td>Schematic Design</td><td>Site plan options, massing, floor plans, preliminary systems narrative, sustainability goal-setting charrette, SD cost estimate</td><td>Selected design direction; SD estimate within budget</td><td>[#] weeks</td></tr>
<tr><td>Design Development</td><td>Coordinated plans, sections, and systems; outline specifications; AHJ pre-application meeting; DD estimate</td><td>Approved DD set and finish selections</td><td>[#] weeks</td></tr>
<tr><td>Construction Documents</td><td>Permit and bid documents, full specifications, QA/QC reviews at 50% and 95%, final estimate</td><td>Permit submittal; approval to bid</td><td>[#] weeks</td></tr>
<tr><td>Bidding / Negotiation</td><td>Pre-bid conference, addenda, bid evaluation or GMP review</td><td>Contract award</td><td>[#] weeks</td></tr>
<tr><td>Construction Administration</td><td>Site visits, OAC meetings, submittals, RFIs, pay application review, punch list, closeout, record documents</td><td>Substantial and final completion; 11-month warranty walk</td><td>[#] months</td></tr>
</tbody>
</table>
<h4>Stakeholder Engagement</h4>
<p>We will [describe engagement: user-group meetings by department, community open houses, board presentations, a project website]. Every meeting ends with written decisions and action items distributed within [number] business days.</p>
<h4>Cost Management</h4>
<p>We will [describe: independent cost estimates at SD, DD, and CD by (estimator name), reconciliation with the CM if one is engaged, a running list of value options and bid alternates]. On our last [number] public projects, bids came in [within X% of / below] the final estimate. [Verify this figure against your records before using it.]</p>
<h4>Schedule Management</h4>
<p>[Describe how you build and track the design schedule, how you coordinate owner review periods, and how you protect the occupancy date.]</p>
<h4>Technology and BIM</h4>
<p>We design in [Revit / ArchiCAD] with our consultants in a shared cloud model ([BIM 360 / ACC / other]), with model development to [LOD 300/350] at CDs and clash detection before each milestone. We will deliver [native model / IFC / PDF record documents] at closeout per the owner's standards.</p>
HTML,
        ],
        [
            'heading' => 'Sustainability, Accessibility, and Code Approach',
            'tip'     => 'Answer what the owner actually requires (state energy code, a LEED mandate, a district design standard) before offering anything more. Name the credentials and past certified projects of the people doing the work. Accessibility should reference the 2010 ADA Standards and the state or local accessibility code; do not promise certification outcomes you cannot control.',
            'body'    => <<<'HTML'
<h4>Sustainable Design</h4>
<p>{{client_name}}'s [policy / RFQ] calls for [LEED Silver / energy code compliance / net-zero ready / other]. Our approach is to set measurable goals at a Schematic Design charrette (energy use intensity target, water reduction, embodied carbon, indoor environmental quality) and track them at every milestone with energy modeling by [consultant]. Our team includes [number] LEED APs and has delivered [number] certified projects, including [project — certification level — year]. [Add WELL, Fitwel, Living Building Challenge, or state high-performance building program only if applicable.]</p>
<h4>Accessibility and Universal Design</h4>
<p>We design to the 2010 ADA Standards for Accessible Design, [state accessibility code, e.g. ICC A117.1 as adopted], and {{client_name}}'s own standards. [If renovation:] We will survey existing barriers during programming and document the path-of-travel improvements required by the alteration, so the owner can plan for them in the budget.</p>
<h4>Code and Approvals</h4>
<p>We will prepare a code analysis under the [IBC edition as adopted by the jurisdiction], [IECC / ASHRAE 90.1 edition], and [local amendments / fire marshal requirements] at the end of Schematic Design, and meet with [building department / fire marshal / planning / historic commission] before Design Development to confirm interpretations early. [Note any known entitlement steps: zoning variance, site plan review, state agency review such as a Division of State Architect or school facilities review.]</p>
HTML,
        ],
        [
            'heading' => 'Quality Assurance and Quality Control',
            'tip'     => 'Owners score QA/QC because document errors turn into change orders they pay for. Name the reviewer (someone not on the project team), the milestones reviewed, and the checklists used. If you track it, cite your change-order rate attributable to errors and omissions on recent projects, but only with verified numbers.',
            'body'    => <<<'HTML'
<p>{{firm_name}}'s quality program is [describe: a written QA/QC manual, a senior technical reviewer independent of the project team, standard checklists]. For {{project_name}}, [Name, AIA], who is not otherwise assigned to the project, will lead independent reviews.</p>
<table>
<thead>
<tr><th>Milestone</th><th>Review Type</th><th>Reviewer</th><th>Focus</th></tr>
</thead>
<tbody>
<tr><td>End of Schematic Design</td><td>Design and program review</td><td>[Name / title]</td><td>Program compliance, code strategy, budget alignment</td></tr>
<tr><td>End of Design Development</td><td>Interdisciplinary coordination review</td><td>[Name / title] and discipline leads</td><td>System coordination, constructability, specification outline</td></tr>
<tr><td>50% Construction Documents</td><td>Technical review and model clash detection</td><td>[Name / title]</td><td>Detailing, envelope, life safety, accessibility</td></tr>
<tr><td>95% Construction Documents</td><td>Independent back-check and bidability review</td><td>[Name / title]; [CM or cost estimator]</td><td>Completeness, spec-to-drawing consistency, bid form and alternates</td></tr>
<tr><td>Construction Administration</td><td>RFI and change-order trend review</td><td>{{project_manager}}</td><td>Root cause of RFIs; lessons learned for closeout</td></tr>
</tbody>
</table>
<p>On our last [number] projects, change orders attributable to design errors or omissions averaged [verified percentage]% of construction cost. [Delete this sentence if you do not track this metric.]</p>
HTML,
        ],
        [
            'heading' => 'Current Workload and Capacity',
            'tip'     => 'Evaluators want proof that the named people have time for this project. Show each key person\'s current commitments with anticipated completion dates and available capacity. Being honest here builds trust; overstating availability is a common reason firms lose at interview.',
            'body'    => <<<'HTML'
<p>{{firm_name}} has the capacity to begin work on {{project_name}} immediately upon notice to proceed. The table below shows current commitments for each key team member and the time they will have available for this project.</p>
<table>
<thead>
<tr><th>Team Member</th><th>Current Projects (Phase)</th><th>Anticipated Completion</th><th>Available for This Project</th></tr>
</thead>
<tbody>
<tr><td>{{principal_in_charge}}</td><td>[Project (phase)], [Project (phase)]</td><td>[Month, year]</td><td>[#]%</td></tr>
<tr><td>{{project_manager}}</td><td>[Project (phase)]</td><td>[Month, year]</td><td>[#]%</td></tr>
<tr><td>[Project Architect]</td><td>[Project (phase)]</td><td>[Month, year]</td><td>[#]%</td></tr>
<tr><td>[Construction Administrator]</td><td>[Project (phase)]</td><td>[Month, year]</td><td>[#]%</td></tr>
</tbody>
</table>
<p>Firm-wide, our current backlog is approximately [number] months of work for our [number]-person staff, and [number] projects will move into construction administration within the next [number] months, freeing design staff for {{project_name}}.</p>
HTML,
        ],
        [
            'heading' => 'DBE / MBE / WBE and Local Participation',
            'tip'     => 'If the RFQ sets a participation goal, state your committed percentage and show it by firm, role, and certifying agency; mismatches between this page and the utilization form are a common disqualifier. Attach current certification letters. If you fall short of the goal, document your good-faith outreach efforts.',
            'body'    => <<<'HTML'
<p>{{client_name}} has established a [DBE / MBE / WBE / SBE / local business] participation goal of [percentage]% for this contract. {{firm_name}} commits to [percentage]% participation through the following firms:</p>
<table>
<thead>
<tr><th>Firm</th><th>Certification (Type / Agency / Expiration)</th><th>Role / Scope</th><th>Committed % of Fee</th></tr>
</thead>
<tbody>
<tr><td>[Firm name]</td><td>[e.g. DBE / State DOT UCP / exp. date]</td><td>[e.g. Civil engineering]</td><td>[#]%</td></tr>
<tr><td>[Firm name]</td><td>[e.g. WBE / City / exp. date]</td><td>[e.g. Landscape architecture]</td><td>[#]%</td></tr>
<tr><td>[Firm name]</td><td>[e.g. MBE / County / exp. date]</td><td>[e.g. Cost estimating]</td><td>[#]%</td></tr>
<tr><td><strong>Total committed participation</strong></td><td></td><td></td><td><strong>[#]%</strong></td></tr>
</tbody>
</table>
<p>[Describe outreach efforts: plan-holder list notices, local chamber or certification-directory search, pre-proposal meetings attended, and any mentor-protégé relationship.]</p>
HTML,
        ],
        [
            'heading' => 'References',
            'tip'     => 'Use owners, not contractors or consultants, and ideally owners of the projects shown in your project sheets. Call each reference before you submit so they expect the call and remember the project. Three to five references is typical unless the RFQ specifies otherwise.',
            'body'    => <<<'HTML'
<p>The following owners have agreed to speak with {{client_name}} about their experience working with our team.</p>
<table>
<thead>
<tr><th>Owner / Organization</th><th>Contact (Name, Title)</th><th>Phone / Email</th><th>Project and Year</th><th>Team Members Involved</th></tr>
</thead>
<tbody>
<tr><td>[Owner]</td><td>[Name, Title]</td><td>[Phone] / [Email]</td><td>[Project — year]</td><td>[Names]</td></tr>
<tr><td>[Owner]</td><td>[Name, Title]</td><td>[Phone] / [Email]</td><td>[Project — year]</td><td>[Names]</td></tr>
<tr><td>[Owner]</td><td>[Name, Title]</td><td>[Phone] / [Email]</td><td>[Project — year]</td><td>[Names]</td></tr>
<tr><td>[Owner]</td><td>[Name, Title]</td><td>[Phone] / [Email]</td><td>[Project — year]</td><td>[Names]</td></tr>
</tbody>
</table>
HTML,
        ],
        [
            'heading' => 'Insurance, Licensure, and Litigation Disclosure',
            'tip'     => 'Match the RFQ minimums exactly and state whether a certificate is attached now or will be furnished at contract. Professional liability for public building work is commonly $1M–$5M per claim depending on project size; check the RFQ. Many public owners require disclosure of claims and litigation over a set period, so answer that question directly rather than leaving it blank.',
            'body'    => <<<'HTML'
<h4>Professional Registration</h4>
<p>{{firm_name}} holds [state] Firm Registration No. {{license_number}}. The Principal-in-Charge and Project Manager are registered architects in [state(s)]. All engineering subconsultants are licensed in [state].</p>
<h4>Insurance</h4>
<table>
<thead>
<tr><th>Coverage</th><th>RFQ Minimum</th><th>Our Current Limits</th><th>Carrier</th></tr>
</thead>
<tbody>
<tr><td>Professional Liability (Errors and Omissions)</td><td>$[amount] per claim / $[amount] aggregate</td><td>$[amount] / $[amount]</td><td>[Carrier]</td></tr>
<tr><td>Commercial General Liability</td><td>$[amount] per occurrence / $[amount] aggregate</td><td>$[amount] / $[amount]</td><td>[Carrier]</td></tr>
<tr><td>Automobile Liability</td><td>$[amount] combined single limit</td><td>$[amount]</td><td>[Carrier]</td></tr>
<tr><td>Workers' Compensation / Employer's Liability</td><td>Statutory / $[amount]</td><td>Statutory / $[amount]</td><td>[Carrier]</td></tr>
<tr><td>Umbrella / Excess</td><td>$[amount]</td><td>$[amount]</td><td>[Carrier]</td></tr>
</tbody>
</table>
<p>A certificate of insurance is [attached in the Appendix / will be provided upon selection], naming {{client_name}} as additional insured where required on general and automobile liability.</p>
<h4>Claims and Litigation</h4>
<p>[State the disclosure the RFQ requests, e.g. "Within the past (number) years, {{firm_name}} has had (no / the following) professional liability claims or litigation arising from its services:" followed by a brief, factual description and status. Have counsel review this language.]</p>
HTML,
        ],
        [
            'heading' => 'Appendix: Required Forms and Attachments',
            'tip'     => 'Missing or unsigned forms are the most common reason an SOQ is found non-responsive before anyone reads the content. Build this list directly from the RFQ\'s submittal requirements and check it off against the physical package. For federal submissions, SF 330 Part I and all Part IIs go here if the agency asks for them as a separate volume.',
            'body'    => <<<'HTML'
<p>The following documents are included with this Statement of Qualifications for RFQ No. {{solicitation_number}}:</p>
<table>
<thead>
<tr><th>Form / Attachment</th><th>Required By</th><th>Included</th></tr>
</thead>
<tbody>
<tr><td>Addenda acknowledgment (Addenda [numbers])</td><td>RFQ Section [#]</td><td>[Yes]</td></tr>
<tr><td>[Owner's qualification questionnaire or response form]</td><td>RFQ Section [#]</td><td>[Yes]</td></tr>
<tr><td>Certificate of insurance or insurer letter</td><td>RFQ Section [#]</td><td>[Yes]</td></tr>
<tr><td>DBE/MBE/WBE utilization form and certification letters</td><td>RFQ Section [#]</td><td>[Yes]</td></tr>
<tr><td>Subconsultant letters of commitment</td><td>RFQ Section [#]</td><td>[Yes]</td></tr>
<tr><td>Non-collusion affidavit</td><td>RFQ Section [#]</td><td>[Yes]</td></tr>
<tr><td>Conflict of interest disclosure</td><td>RFQ Section [#]</td><td>[Yes]</td></tr>
<tr><td>Debarment / suspension certification</td><td>RFQ Section [#]</td><td>[Yes]</td></tr>
<tr><td>W-9</td><td>RFQ Section [#]</td><td>[Yes]</td></tr>
<tr><td>[State or local forms, e.g. drug-free workplace, E-Verify, Iran/Israel boycott certifications]</td><td>RFQ Section [#]</td><td>[Yes]</td></tr>
<tr><td>SF 330 Part I and Part II (federal only)</td><td>[Agency / solicitation section]</td><td>[Yes / N/A]</td></tr>
</tbody>
</table>
<p>Submitted by {{firm_name}}, {{firm_address}}, {{firm_phone}}, {{firm_email}}, on {{submittal_date}}.</p>
HTML,
        ],
    ],
];
