<?php
if (!defined('ABSPATH')) exit;

return [
    'slug'     => 'architecture-fee-proposal',
    'title'    => 'Architectural Services Fee Proposal',
    'industry' => 'architecture',
    'type'     => 'proposal',
    'summary'  => 'A proposal for architectural services that defines scope by AIA phase, offers fee as a percentage of construction cost, stipulated sum, or hourly not-to-exceed, and spells out the phase fee split, hourly rates, reimbursables, additional services, assumptions and exclusions, schedule, terms, and acceptance.',
    'use_when' => [
        'An owner or developer has asked for your fee after a conversation, referral, or site visit',
        'You were ranked first under QBS and the owner has asked for a fee proposal to negotiate the contract',
        'You want a clear scope-and-fee letter to precede or attach to an AIA B101, B104, or owner-drafted agreement',
        'The project scope is uncertain and you need to present fee options (percentage, stipulated sum, hourly NTE) side by side',
    ],
    'length'   => '6–12 pages',

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
        'submittal_date'      => 'Submittal date',
        'project_manager'     => 'Project manager / project architect name',
        'construction_budget' => 'Owner\'s construction budget (e.g. $4.2M)',
    ],

    'checklist' => [
        'Construction budget used for the fee basis is the owner\'s number, stated in writing, and clearly defined (construction cost only, excluding land, FF&E, fees, and owner contingency)',
        'Phase fee split adds up to 100% and each phase dollar amount matches the total fee',
        'Scope of each phase matches the deliverables listed; nothing is promised in the narrative that is not in the fee',
        'Every consultant included in the fee has provided a written proposal, and consultant markup (if any) is stated',
        'Anything you are not doing (survey, geotech, hazmat, commissioning, LEED certification, FF&E, renderings beyond the stated number) is listed as excluded or as an additional service',
        'Number of design options, owner review meetings, CA site visits, and CA duration are stated as specific numbers',
        'Hourly rate schedule is current and includes an annual escalation date',
        'Reimbursable categories and markup are stated, with a not-to-exceed allowance if the owner requires one',
        'Assumptions include delivery method, number of bid packages, and construction duration used for CA fee',
        'Payment terms, invoicing frequency, and late payment and suspension language are included',
        'Professional liability limits and any limitation of liability are consistent with your policy and carrier guidance',
        'Instruments of service / ownership of documents and termination language have been reviewed against your standard contract',
        'Proposal validity period is stated (typically 30–90 days)',
        'Acceptance block names the person authorized to sign for the owner, and you know which contract form will follow',
        'Registration number and signing principal\'s credentials are correct for the project\'s state',
    ],

    'sections' => [
        [
            'heading' => 'Cover Letter',
            'tip'     => 'One page. Restate the project in the owner\'s words, name your recommended fee approach and the total, and say what you need from them to start. Owners read the cover letter and the fee table first, so make the number and what it buys easy to find.',
            'body'    => <<<'HTML'
<p>{{submittal_date}}</p>
<p>{{client_contact}}<br>{{client_name}}<br>[Owner mailing address]</p>
<p><strong>Re: Proposal for Architectural Services, {{project_name}}, {{project_location}}</strong></p>
<p>Dear {{client_contact}},</p>
<p>Thank you for the opportunity to propose architectural services for {{project_name}}. Based on our [meeting / site visit / review of the program] on [date], we understand that {{client_name}} plans to [one-sentence description, e.g. "construct a two-story, approximately 18,000 SF medical office building on the vacant parcel at the corner of Main and 3rd"], with a target construction budget of {{construction_budget}} and [occupancy / construction start] by [month, year].</p>
<p>This proposal describes the services {{firm_name}} and our engineering consultants will provide through each phase of design and construction, the deliverables at each milestone, and three ways to structure our compensation. We recommend [Option A / B / C] because [one-sentence reason, e.g. "the program is well defined and a stipulated sum gives you cost certainty"]. Under that option, our fee for Basic Services is $[amount], plus reimbursable expenses.</p>
<p>{{project_manager}} will lead the project and be your day-to-day contact. We are ready to begin within [number] days of your written authorization and receipt of [retainer / signed agreement].</p>
<p>We look forward to working with you.</p>
<p>Sincerely,</p>
<p>[Signature]<br>{{contact_name}}, [AIA]<br>{{contact_title}}<br>{{firm_name}}<br>{{firm_phone}} | {{firm_email}}</p>
HTML,
        ],
        [
            'heading' => 'Project Understanding',
            'tip'     => 'Write down every fact the fee depends on: size, building type, construction type, new vs. renovation, delivery method, and budget. If any of these change later, this section is what justifies an additional service or fee adjustment. Keep it factual and specific.',
            'body'    => <<<'HTML'
<p>Our proposal is based on the following understanding of {{project_name}}. If any of these parameters change, we will discuss the effect on scope and fee with you before proceeding.</p>
<table>
<thead>
<tr><th>Parameter</th><th>Basis of This Proposal</th></tr>
</thead>
<tbody>
<tr><td>Owner</td><td>{{client_name}}</td></tr>
<tr><td>Project location</td><td>{{project_location}}</td></tr>
<tr><td>Project type</td><td>[New construction / renovation / addition / tenant improvement]</td></tr>
<tr><td>Building use and occupancy</td><td>[Use; IBC occupancy classification, e.g. Group B]</td></tr>
<tr><td>Gross area</td><td>Approximately [number] SF, [number] stories</td></tr>
<tr><td>Construction type</td><td>[e.g. Type V-B wood frame / Type II-B steel]</td></tr>
<tr><td>Site</td><td>[Acreage; existing conditions; utilities available / to be extended]</td></tr>
<tr><td>Construction budget (Cost of the Work)</td><td>{{construction_budget}}</td></tr>
<tr><td>Project delivery method</td><td>[Design-bid-build, single prime / CM at-risk / negotiated with a selected GC]</td></tr>
<tr><td>Sustainability goals</td><td>[Energy code compliance only / LEED (level) / other]</td></tr>
<tr><td>Target schedule</td><td>Design start [month, year]; construction start [month, year]; occupancy [month, year]</td></tr>
<tr><td>Owner-provided program</td><td>[Program document name and date, or "to be developed as an additional service"]</td></tr>
</tbody>
</table>
HTML,
        ],
        [
            'heading' => 'Project Team',
            'tip'     => 'Name the people, not just the firms. Owners hire the project architect as much as the firm. List each consultant included in your fee separately from consultants the owner will hire directly, so there is no confusion about who is responsible for survey, geotechnical, or commissioning.',
            'body'    => <<<'HTML'
<h4>{{firm_name}}</h4>
<ul>
<li><strong>{{contact_name}}, [AIA]</strong> — Principal-in-Charge. [One sentence on role and relevant experience.]</li>
<li><strong>{{project_manager}}, [AIA]</strong> — Project Manager / Project Architect. [One sentence.]</li>
<li><strong>[Name]</strong> — [Designer / Interior Designer / Construction Administrator]. [One sentence.]</li>
</ul>
<h4>Consultants Included in Our Fee</h4>
<table>
<thead>
<tr><th>Discipline</th><th>Firm</th><th>Lead</th></tr>
</thead>
<tbody>
<tr><td>Structural Engineering</td><td>[Firm]</td><td>[Name, PE, SE]</td></tr>
<tr><td>Mechanical, Electrical, Plumbing, and Fire Protection Engineering</td><td>[Firm]</td><td>[Name, PE]</td></tr>
<tr><td>Civil Engineering</td><td>[Firm]</td><td>[Name, PE]</td></tr>
<tr><td>Landscape Architecture</td><td>[Firm]</td><td>[Name, PLA]</td></tr>
<tr><td>[Specialty: cost estimating / acoustics / AV / lighting]</td><td>[Firm]</td><td>[Name]</td></tr>
</tbody>
</table>
<h4>Consultants Retained Directly by the Owner</h4>
<p>[Land surveyor (boundary, topographic, and utility survey); geotechnical engineer; hazardous materials surveyor; commissioning authority; testing and inspection agency; others as applicable.] We will coordinate our work with these consultants and can recommend firms on request.</p>
HTML,
        ],
        [
            'heading' => 'Scope of Basic Services by Phase',
            'tip'     => 'Organize scope by the AIA B101 phases so the owner can compare it to the contract that follows. Be specific about quantities: number of design options, meetings, presentations, and estimate iterations. Vague scope is the number one cause of unpaid additional work.',
            'body'    => <<<'HTML'
<p>{{firm_name}} will provide the following Basic Services, organized by the phases of the AIA B101 Standard Form of Agreement Between Owner and Architect.</p>
<h4>1. Schematic Design (SD)</h4>
<ul>
<li>Kickoff meeting to confirm program, budget, schedule, and owner decision-makers</li>
<li>Review of owner-provided program, survey, and geotechnical report</li>
<li>Preliminary code and zoning analysis</li>
<li>Up to [number] site plan and massing options, refined to one selected scheme</li>
<li>Schematic floor plans, building sections, and exterior elevations</li>
<li>Consultant system narratives (structural, MEP, civil)</li>
<li>Preliminary estimate of the Cost of the Work [by our cost consultant / in square-foot format]</li>
<li>Up to [number] owner review meetings and [number] presentation(s) to [board / committee / planning commission]</li>
</ul>
<h4>2. Design Development (DD)</h4>
<ul>
<li>Developed plans, sections, elevations, and typical wall sections at [scale]</li>
<li>Coordinated structural, MEP, and civil design development drawings</li>
<li>Outline specifications</li>
<li>Selection of major materials, systems, and [number] interior finish palette options</li>
<li>Pre-application meeting with the authority having jurisdiction</li>
<li>Updated estimate of the Cost of the Work and reconciliation with the budget</li>
<li>Up to [number] owner review meetings</li>
</ul>
<h4>3. Construction Documents (CD)</h4>
<ul>
<li>Drawings and project manual (specifications in CSI MasterFormat) suitable for permit and bidding</li>
<li>Internal quality control reviews at [50]% and [95]% completion</li>
<li>Final estimate of the Cost of the Work</li>
<li>Submission for building permit and response to [one / two] rounds of plan review comments</li>
<li>Up to [number] owner review meetings</li>
</ul>
<h4>4. Bidding or Negotiation</h4>
<ul>
<li>Assist the owner in preparing bidding documents and identifying prospective bidders</li>
<li>Attend one pre-bid conference and respond to bidder questions through addenda</li>
<li>Review bids and recommend award [or: assist in negotiating a GMP with the selected contractor]</li>
</ul>
<h4>5. Construction Administration (CA)</h4>
<ul>
<li>Construction duration assumed: [number] months</li>
<li>Site visits: up to [number] visits ([frequency, e.g. every other week]), including attendance at OAC meetings, with a written field report after each</li>
<li>Review of submittals and shop drawings (up to [two] reviews per submittal)</li>
<li>Responses to requests for information (RFIs)</li>
<li>Review of contractor applications for payment and certification of amounts due</li>
<li>Preparation of change order documents and review of contractor change proposals</li>
<li>Substantial completion inspection and punch list; one back-check inspection</li>
<li>Review of closeout documents; record drawings based on contractor as-builts in [PDF / CAD / Revit] format</li>
<li>One site visit approximately 11 months after substantial completion to review warranty items</li>
</ul>
HTML,
        ],
        [
            'heading' => 'Deliverables Summary',
            'tip'     => 'A one-page table of what the owner receives at each milestone prevents arguments later about whether a phase is complete. It also gives you a clean trigger for phase-based invoicing and owner sign-off.',
            'body'    => <<<'HTML'
<table>
<thead>
<tr><th>Phase</th><th>Deliverables</th><th>Owner Approval Required</th></tr>
</thead>
<tbody>
<tr><td>Schematic Design</td><td>SD drawing set (PDF), code analysis summary, systems narratives, SD cost estimate</td><td>Written approval of SD and budget before DD begins</td></tr>
<tr><td>Design Development</td><td>DD drawing set (PDF), outline specifications, finish board, DD cost estimate</td><td>Written approval of DD and budget before CD begins</td></tr>
<tr><td>Construction Documents</td><td>Permit set and bid set (PDF), project manual, final cost estimate</td><td>Approval to submit for permit and to bid</td></tr>
<tr><td>Bidding / Negotiation</td><td>Addenda, bid tabulation and recommendation</td><td>Contract award</td></tr>
<tr><td>Construction Administration</td><td>Field reports, submittal and RFI logs, certified pay applications, punch list, record drawings</td><td>Substantial and final completion</td></tr>
</tbody>
</table>
HTML,
        ],
        [
            'heading' => 'Compensation: Fee Options',
            'tip'     => 'Presenting options lets the owner choose the risk profile while you control what each option includes. Percentage fees for new commercial and institutional buildings commonly fall in the 6%–12% range depending on size and complexity, with renovations higher; confirm against your own historic data and state fee guidelines for public work. For hourly work, always pair a not-to-exceed with a defined scope, or the NTE becomes a fixed fee with open-ended scope.',
            'body'    => <<<'HTML'
<p>We offer three ways to structure compensation for Basic Services. Each option covers the same scope described above; they differ in how the fee responds to changes in cost and scope.</p>
<table>
<thead>
<tr><th>Option</th><th>How It Works</th><th>Fee for Basic Services</th><th>Best When</th></tr>
</thead>
<tbody>
<tr><td><strong>A. Percentage of Construction Cost</strong></td><td>Fee equals [number]% of the Cost of the Work. Billed on the current estimate during design and adjusted to the actual Cost of the Work (accepted bid or GMP plus approved changes).</td><td>[number]% × {{construction_budget}} = $[amount] (estimated)</td><td>Scope and budget are likely to evolve together</td></tr>
<tr><td><strong>B. Stipulated Sum</strong></td><td>A fixed fee for the defined scope. Changes in program, size, or budget beyond [number]% are adjusted as Additional Services.</td><td>$[amount]</td><td>Program and budget are well defined</td></tr>
<tr><td><strong>C. Hourly, Not to Exceed</strong></td><td>Billed at the hourly rates in this proposal for time actually spent, up to a not-to-exceed amount that will not be exceeded without the owner's written approval.</td><td>Not to exceed $[amount]</td><td>Early-stage, feasibility, or uncertain scope</td></tr>
</tbody>
</table>
<p>Reimbursable expenses and Additional Services are compensated separately under all options, as described below.</p>
<p><strong>Our recommendation:</strong> [Option letter], because [reason tied to this project].</p>
HTML,
        ],
        [
            'heading' => 'Fee Allocation by Phase',
            'tip'     => 'A common AIA-based split is roughly SD 15%, DD 20%, CD 40%, Bidding 5%, CA 20%, but adjust for the project: renovations often need more in SD for existing conditions, and long construction schedules need more in CA. Include consultant fees in the table so the owner sees the whole picture, and make sure the phase totals match the fee option exactly.',
            'body'    => <<<'HTML'
<p>The fee for Basic Services will be allocated and invoiced by phase as follows. Within each phase, invoices are based on percent complete.</p>
<table>
<thead>
<tr><th>Phase</th><th>% of Fee</th><th>Architecture</th><th>Consultants</th><th>Phase Total</th></tr>
</thead>
<tbody>
<tr><td>Schematic Design</td><td>[15]%</td><td>$[amount]</td><td>$[amount]</td><td>$[amount]</td></tr>
<tr><td>Design Development</td><td>[20]%</td><td>$[amount]</td><td>$[amount]</td><td>$[amount]</td></tr>
<tr><td>Construction Documents</td><td>[40]%</td><td>$[amount]</td><td>$[amount]</td><td>$[amount]</td></tr>
<tr><td>Bidding / Negotiation</td><td>[5]%</td><td>$[amount]</td><td>$[amount]</td><td>$[amount]</td></tr>
<tr><td>Construction Administration</td><td>[20]%</td><td>$[amount]</td><td>$[amount]</td><td>$[amount]</td></tr>
<tr><td><strong>Total Basic Services</strong></td><td><strong>100%</strong></td><td><strong>$[amount]</strong></td><td><strong>$[amount]</strong></td><td><strong>$[amount]</strong></td></tr>
</tbody>
</table>
<h4>Consultant Fee Breakdown</h4>
<table>
<thead>
<tr><th>Consultant</th><th>Discipline</th><th>Fee</th></tr>
</thead>
<tbody>
<tr><td>[Firm]</td><td>Structural</td><td>$[amount]</td></tr>
<tr><td>[Firm]</td><td>MEP / Fire Protection</td><td>$[amount]</td></tr>
<tr><td>[Firm]</td><td>Civil</td><td>$[amount]</td></tr>
<tr><td>[Firm]</td><td>Landscape</td><td>$[amount]</td></tr>
<tr><td>[Firm]</td><td>[Specialty]</td><td>$[amount]</td></tr>
</tbody>
</table>
<p>[If applicable:] Consultant fees include a [number]% coordination and administration markup.</p>
HTML,
        ],
        [
            'heading' => 'Hourly Rate Schedule',
            'tip'     => 'Include rates for every classification that might bill time, even under a stipulated sum, because Additional Services will be billed from this table. State when rates escalate (usually annually on a fixed date) so there is no surprise on a multi-year project.',
            'body'    => <<<'HTML'
<p>The following rates apply to hourly services, Additional Services, and Option C. Rates are effective through [date] and are subject to annual adjustment of up to [number]% on [month and day] each year.</p>
<table>
<thead>
<tr><th>Classification</th><th>Hourly Rate</th></tr>
</thead>
<tbody>
<tr><td>Principal</td><td>$[rate]</td></tr>
<tr><td>Senior Project Manager</td><td>$[rate]</td></tr>
<tr><td>Project Manager / Project Architect</td><td>$[rate]</td></tr>
<tr><td>Senior Designer</td><td>$[rate]</td></tr>
<tr><td>Architect / Designer II</td><td>$[rate]</td></tr>
<tr><td>Designer I / BIM Technician</td><td>$[rate]</td></tr>
<tr><td>Interior Designer</td><td>$[rate]</td></tr>
<tr><td>Construction Administrator</td><td>$[rate]</td></tr>
<tr><td>Administrative</td><td>$[rate]</td></tr>
</tbody>
</table>
<p>Consultant hourly services will be billed at the consultant's current rates [plus (number)%].</p>
HTML,
        ],
        [
            'heading' => 'Reimbursable Expenses',
            'tip'     => 'List the categories, the markup (typically 0%–15%), and whether there is a not-to-exceed allowance. Many public and institutional owners require a reimbursable allowance; for private clients, a clear list and receipt-backed invoicing is usually enough.',
            'body'    => <<<'HTML'
<p>Reimbursable expenses are in addition to the fee for Basic Services and will be invoiced at actual cost [plus (number)%] with supporting documentation. [We propose a reimbursable allowance of $(amount), which will not be exceeded without the owner's written approval.]</p>
<ul>
<li>Printing, plotting, and reproduction of drawings and specifications beyond [number] review sets</li>
<li>Permit, plan review, and agency filing fees advanced on the owner's behalf</li>
<li>Delivery, courier, and overnight shipping</li>
<li>Travel beyond [number] miles from our office, at the current IRS mileage rate, plus lodging and meals where required</li>
<li>Renderings, physical models, or animations requested beyond those included in Basic Services</li>
<li>Bid document distribution or plan room fees</li>
<li>[Other project-specific items]</li>
</ul>
<p>In-house electronic file sharing, normal office printing, and [telephone / software costs] are included in the fee and are not billed separately.</p>
HTML,
        ],
        [
            'heading' => 'Additional Services',
            'tip'     => 'List the services owners often assume are included, and price them as optional add-ons (lump sum or hourly). This protects your fee and often becomes additional revenue. State plainly that Additional Services require the owner\'s written authorization before work begins.',
            'body'    => <<<'HTML'
<p>The following services are not included in Basic Services. We can provide them at the owner's request, upon written authorization, for the fee shown or on an hourly basis at the rates above.</p>
<table>
<thead>
<tr><th>Additional Service</th><th>Proposed Fee</th></tr>
</thead>
<tbody>
<tr><td>Programming and space needs analysis</td><td>$[amount] lump sum / hourly</td></tr>
<tr><td>Existing conditions survey and as-built documentation (including laser scanning)</td><td>$[amount]</td></tr>
<tr><td>Zoning variance, special use permit, or design review board applications and hearings</td><td>Hourly</td></tr>
<tr><td>LEED or other third-party certification documentation and administration</td><td>$[amount]</td></tr>
<tr><td>Energy modeling beyond code compliance</td><td>$[amount]</td></tr>
<tr><td>Furniture, fixtures, and equipment (FF&amp;E) selection, specification, and procurement</td><td>$[amount] or [number]% of FF&amp;E budget</td></tr>
<tr><td>Signage and wayfinding design</td><td>$[amount]</td></tr>
<tr><td>Additional photorealistic renderings (per view)</td><td>$[amount]</td></tr>
<tr><td>Multiple bid packages, early release packages, or phased construction documents</td><td>Hourly</td></tr>
<tr><td>Bid alternates beyond [number]</td><td>Hourly</td></tr>
<tr><td>Redesign due to owner-directed changes after phase approval, or to meet budget when the owner has increased scope</td><td>Hourly</td></tr>
<tr><td>Construction administration beyond [number] months or [number] site visits</td><td>$[amount] per month / per visit</td></tr>
<tr><td>Review of contractor substitution requests beyond [number]</td><td>Hourly</td></tr>
<tr><td>Post-occupancy evaluation</td><td>$[amount]</td></tr>
<tr><td>Expert witness, litigation, or dispute resolution support</td><td>Hourly</td></tr>
</tbody>
</table>
HTML,
        ],
        [
            'heading' => 'Owner Responsibilities',
            'tip'     => 'The AIA B101 lists owner responsibilities for a reason: missing survey or geotech data stalls design and invites finger-pointing. Spell out what you need, and by when, so schedule delays caused by late information are clearly not yours.',
            'body'    => <<<'HTML'
<p>To keep the project on schedule, {{client_name}} will provide the following at its own expense:</p>
<ul>
<li>A written program of requirements, budget, and schedule, and a single representative authorized to make decisions</li>
<li>A boundary, topographic, and utility survey sealed by a licensed surveyor, in CAD format, before the start of Schematic Design</li>
<li>A geotechnical investigation and report before the start of Design Development</li>
<li>Hazardous materials survey for any existing building to be altered or demolished</li>
<li>Existing building drawings and records available to the owner</li>
<li>Legal, accounting, and insurance counsel as needed</li>
<li>Testing and special inspections required during construction, and a commissioning authority if required</li>
<li>Timely review of submittals: written comments within [number] business days of each milestone submission</li>
</ul>
HTML,
        ],
        [
            'heading' => 'Assumptions and Exclusions',
            'tip'     => 'This section does more to protect your margin than any other. Write it after the scope and fee are final, and include every assumption you used to estimate hours. Excluding something here is far easier than arguing about it in construction.',
            'body'    => <<<'HTML'
<h4>Assumptions</h4>
<ul>
<li>The project will be designed and bid as a single package and constructed in a single phase.</li>
<li>The Cost of the Work will not exceed {{construction_budget}}. If the owner increases the budget or scope, the fee will be adjusted accordingly.</li>
<li>Construction will be completed in [number] months from notice to proceed.</li>
<li>The design will comply with the codes in effect on the date of this proposal: [IBC edition], [IECC or ASHRAE 90.1 edition], [accessibility standard], and [local amendments].</li>
<li>No more than [number] rounds of plan review comments will be required to obtain a permit.</li>
<li>Once approved, phase deliverables will not be substantially revised.</li>
<li>Drawings will be produced in [Revit / AutoCAD]; model and file deliverables will be in [PDF / native format] per our standard practice.</li>
<li>[Additional project-specific assumptions]</li>
</ul>
<h4>Exclusions</h4>
<ul>
<li>Land surveying, geotechnical engineering, and hazardous materials investigation or abatement design</li>
<li>Environmental assessments, wetland delineation, and traffic studies</li>
<li>Off-site utility extensions or roadway improvements beyond the property line</li>
<li>Commissioning, special inspections, and materials testing</li>
<li>Detailed cost estimating beyond what is described in Basic Services</li>
<li>Seismic or structural evaluation of existing buildings beyond the scope of the proposed work</li>
<li>Design of specialized equipment (e.g. food service, medical, laboratory, audiovisual, security) except for coordination of owner-provided information</li>
<li>Services related to hazardous materials, mold, or asbestos</li>
<li>Permit, impact, and plan review fees</li>
<li>[Additional project-specific exclusions]</li>
</ul>
HTML,
        ],
        [
            'heading' => 'Project Schedule',
            'tip'     => 'Show the design schedule with owner review periods built in, because owner review time is where schedules usually slip. Tie the dates to the notice to proceed rather than calendar dates if authorization timing is uncertain.',
            'body'    => <<<'HTML'
<p>We propose the following schedule, measured from written notice to proceed. Durations include [number] business days for owner review at the end of each phase.</p>
<table>
<thead>
<tr><th>Phase / Milestone</th><th>Duration</th><th>Target Completion</th></tr>
</thead>
<tbody>
<tr><td>Notice to proceed and kickoff meeting</td><td>—</td><td>[Date / Week 0]</td></tr>
<tr><td>Schematic Design (including owner review)</td><td>[#] weeks</td><td>[Date / Week #]</td></tr>
<tr><td>Design Development (including owner review)</td><td>[#] weeks</td><td>[Date / Week #]</td></tr>
<tr><td>Construction Documents (including owner review)</td><td>[#] weeks</td><td>[Date / Week #]</td></tr>
<tr><td>Permit review (by the authority having jurisdiction)</td><td>[#] weeks (estimated)</td><td>[Date / Week #]</td></tr>
<tr><td>Bidding / Negotiation</td><td>[#] weeks</td><td>[Date / Week #]</td></tr>
<tr><td>Construction Administration</td><td>[#] months</td><td>[Date]</td></tr>
</tbody>
</table>
<p>Permit review durations are controlled by the jurisdiction and are estimated. We will update the schedule at each phase and notify you promptly of any change.</p>
HTML,
        ],
        [
            'heading' => 'Terms and Conditions',
            'tip'     => 'Keep this a short summary and state which full contract form will govern (AIA B101 or B104 is standard; many owners use their own). Have your attorney and professional liability carrier review indemnity, standard of care, and limitation of liability language, especially on owner-drafted contracts.',
            'body'    => <<<'HTML'
<ul>
<li><strong>Agreement.</strong> Upon acceptance, the services will be governed by [AIA Document B101–2017 / B104–2017 / the owner's standard agreement, subject to mutually agreed modifications], which will incorporate this proposal by reference.</li>
<li><strong>Standard of care.</strong> Services will be performed with the skill and care ordinarily used by members of the architectural profession practicing under similar circumstances at the same time and in the same locality.</li>
<li><strong>Invoicing and payment.</strong> Invoices are issued monthly based on percent complete by phase (or hours expended for hourly services) and are due within [30] days. Balances unpaid after [number] days accrue interest at [rate]% per month or the maximum rate allowed by law, whichever is less.</li>
<li><strong>Suspension.</strong> If payment is not received within [number] days, {{firm_name}} may suspend services upon [seven] days' written notice.</li>
<li><strong>Retainer.</strong> [A retainer of $(amount) is due upon acceptance and will be applied to the final invoice. / No retainer is required.]</li>
<li><strong>Instruments of service.</strong> Drawings, specifications, and models are instruments of service; {{firm_name}} retains copyright. The owner receives a non-exclusive license to use them for this project upon payment of amounts due.</li>
<li><strong>Construction cost.</strong> Estimates of the Cost of the Work represent our professional judgment; we do not guarantee that bids or negotiated prices will not vary from them.</li>
<li><strong>Insurance.</strong> {{firm_name}} maintains professional liability insurance of $[amount] per claim and $[amount] aggregate, and general liability, automobile, and workers' compensation coverage.</li>
<li><strong>Termination.</strong> Either party may terminate on [seven] days' written notice for cause, or the owner may terminate for convenience; the architect will be paid for services performed and reimbursable expenses incurred through termination [plus termination expenses, if applicable].</li>
<li><strong>Proposal validity.</strong> This proposal is valid for [number] days from {{submittal_date}}.</li>
</ul>
HTML,
        ],
        [
            'heading' => 'Acceptance and Authorization',
            'tip'     => 'Ask for a signature on the proposal even if a full AIA contract will follow; it authorizes you to start and establishes scope and fee in the meantime. Make sure the person signing for the owner actually has authority to commit funds.',
            'body'    => <<<'HTML'
<p>If this proposal is acceptable, please indicate the selected fee option, sign below, and return a copy to {{firm_email}}. Your signature authorizes {{firm_name}} to begin work on {{project_name}} under the terms described above, pending execution of the formal agreement.</p>
<p><strong>Selected fee option:</strong> [ ] A. Percentage of Construction Cost · [ ] B. Stipulated Sum · [ ] C. Hourly, Not to Exceed</p>
<table>
<thead>
<tr><th>Accepted for {{client_name}}</th><th>Submitted by {{firm_name}}</th></tr>
</thead>
<tbody>
<tr><td>Signature: ______________________________</td><td>Signature: ______________________________</td></tr>
<tr><td>Name: [Authorized owner representative]</td><td>Name: {{contact_name}}, [AIA]</td></tr>
<tr><td>Title: [Title]</td><td>Title: {{contact_title}}</td></tr>
<tr><td>Date: ________________</td><td>Date: {{submittal_date}}</td></tr>
</tbody>
</table>
<p>{{firm_name}} | {{firm_address}} | {{firm_phone}} | {{firm_website}}<br>Architectural Firm Registration No. {{license_number}}</p>
HTML,
        ],
    ],
];
