<?php
if (!defined('ABSPATH')) exit;

return [
    'slug'     => 'engineering-fee-proposal',
    'title'    => 'Engineering Services Fee Proposal',
    'industry' => 'engineering',
    'type'     => 'proposal',
    'summary'  => 'A detailed fee proposal for civil, structural, or MEP engineering services: scope by task, deliverables at 30/60/90/100%, a labor-hour matrix by staff classification, rate and multiplier explanation, subconsultant fees, direct expenses, assumptions and exclusions, schedule, terms, and acceptance.',
    'use_when' => [
        'An owner, architect, or developer has asked for your scope and fee after selecting you or shortlisting you',
        'A public agency has ranked you first under QBS and requested a fee proposal to open negotiations',
        'Pricing a task order under an on-call / IDIQ contract with pre-negotiated rates',
        'Serving as an MEP or structural consultant to an architect who needs your fee to build their own proposal',
        'Re-scoping an existing contract for an additional-services amendment',
    ],
    'length'   => '6–12 pages plus labor-hour spreadsheet and subconsultant proposals',

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
        'project_manager'     => 'Proposed project manager (name, PE)',
        'total_fee'           => 'Total proposed fee (e.g., $148,500)',
    ],

    'checklist' => [
        'Every task in the scope narrative appears in the labor-hour matrix, and every task in the matrix is described in the scope',
        'Labor-hour matrix totals by row and column foot correctly and tie to the fee summary to the dollar',
        'Hours per sheet or per deliverable are sanity-checked against similar completed projects (not just top-down from a target fee)',
        'Rates match your current rate schedule, the on-call contract rates, or audited overhead rate (FAR Part 31 / state DOT audit) as applicable',
        'Subconsultant proposals are attached, current, and cover the same scope, assumptions, and schedule as yours; markup (if any) is stated',
        'Direct expenses are itemized with the basis (mileage rate, printing, lab tests, permit fees) and state whether fees are pass-through',
        'Compensation method (lump sum, time-and-materials NTE, cost-plus-fixed-fee, percent of construction) is explicit for each task',
        'Assumptions list covers number of design alternatives, review cycles, meetings, site visits, and construction duration',
        'Exclusions address permit/impact fees, special inspections, environmental remediation, LEED/energy modeling, and redesign after approval',
        'Construction phase services are priced for a stated construction duration and number of site visits / RFIs / submittals',
        'Schedule accounts for owner review time and permit lead times; escalation clause included for multi-year work',
        'Standard of care, limitation of liability, and insurance language align with your professional liability policy and have been reviewed by your insurance broker or counsel',
        'Proposal validity period stated (commonly 60–90 days)',
        'Signed by an authorized officer; acceptance block ready for the client\'s signature',
        'No leftover "[bracket]" placeholders, other clients\' names, or hidden spreadsheet rows',
    ],

    'sections' => [
        [
            'heading' => 'Cover Letter',
            'tip'     => 'State the total fee and compensation method in the first paragraph — the reader is looking for it. Confirm what you understood the scope to be, reference any prior meeting or scoping call, and point to the assumptions section. Keep it to one page.',
            'body'    => <<<'HTML'
<p>{{submittal_date}}</p>
<p>{{client_contact}}<br>{{client_name}}<br>[Street address]<br>[City, ST ZIP]</p>
<p><strong>Re: Proposal for Engineering Services — {{project_name}} — {{solicitation_number}}</strong></p>
<p>Dear {{client_contact}}:</p>
<p>Thank you for the opportunity to propose on {{project_name}}. Following our [scoping meeting / site visit / call] on [date], {{firm_name}} is pleased to provide [civil / structural / mechanical, electrical, and plumbing] engineering services for the project described below for a total fee of <strong>{{total_fee}}</strong>, billed on a [lump-sum by task / time-and-materials not-to-exceed / cost-plus-fixed-fee] basis.</p>
<p>This proposal describes our scope by task, deliverables at each design milestone, the staff hours we have estimated for each task, our rates, subconsultant and expense costs, and the assumptions on which the fee is based. We have tried to be explicit about assumptions so that there are no surprises later; if any assumption does not match your expectations, we are glad to adjust the scope and fee.</p>
<p>{{project_manager}} will serve as project manager and your primary contact. We are prepared to begin within [number] days of authorization and to deliver 100% documents by [date], subject to the review durations noted in the schedule.</p>
<p>This proposal is valid for [60/90] days from the date above. Please contact me at {{firm_phone}} or {{firm_email}} with any questions.</p>
<p>Sincerely,</p>
<p>[Signature]<br>{{contact_name}}, [PE]<br>{{contact_title}}<br>{{firm_name}}<br>{{firm_address}}</p>
HTML,
        ],
        [
            'heading' => 'Project Description and Understanding',
            'tip'     => 'Restate the project in enough detail that the scope and fee are anchored to something measurable: size, length, square footage, number of structures, construction budget. If the project grows, this paragraph is what justifies an additional-services request.',
            'body'    => <<<'HTML'
<p>{{client_name}} intends to [describe the project — e.g., construct a [number]-square-foot, [number]-story [building type] with [structural system] / reconstruct [number] linear feet of [street] including [storm sewer, water main, sidewalks, ADA ramps] / replace the [HVAC / electrical service / plumbing systems] serving [facility]] at {{project_location}}.</p>
<table>
<thead><tr><th>Project Parameter</th><th>Basis of This Proposal</th></tr></thead>
<tbody>
<tr><td>Project size</td><td>[Square feet / linear feet / acres / number of structures]</td></tr>
<tr><td>Estimated construction cost</td><td>$[amount] (provided by [owner / architect / our preliminary estimate])</td></tr>
<tr><td>Delivery method</td><td>[Design-bid-build / design-build (as designer to contractor) / CM at-risk]</td></tr>
<tr><td>Our role</td><td>[Prime consultant to owner / subconsultant to [Architect]]</td></tr>
<tr><td>Funding</td><td>[Private / local / state grant / federal-aid — applicable requirements]</td></tr>
<tr><td>Applicable codes and standards</td><td>[IBC [edition] as adopted by [jurisdiction]; [State] DOT specifications; owner standards; ASCE 7; NEC; IECC/ASHRAE 90.1]</td></tr>
<tr><td>Target bid / construction start</td><td>[Month year]</td></tr>
</tbody>
</table>
HTML,
        ],
        [
            'heading' => 'Scope of Services by Task',
            'tip'     => 'Write each task so a stranger could tell whether it was done. Use quantities (number of meetings, sheets, site visits, review cycles) wherever possible — vague verbs like "coordinate" and "assist" are where scope creep comes from. Keep task numbers identical to the labor-hour matrix and invoices.',
            'body'    => <<<'HTML'
<h4>Task 1 — Project Management and Meetings</h4>
<ul>
<li>Kickoff meeting with {{client_name}} [and architect / stakeholders] to confirm goals, criteria, schedule, and communication protocols.</li>
<li>[Number] [biweekly / monthly] progress meetings ([virtual / in person]) and a milestone review meeting at 30%, 60%, and 90%.</li>
<li>Monthly progress report and invoice showing percent complete by task, schedule status, and decisions needed.</li>
<li>Management and coordination of subconsultants.</li>
</ul>
<h4>Task 2 — Data Collection and Existing Conditions</h4>
<ul>
<li>Review of available record drawings, GIS data, prior reports, and utility maps provided by {{client_name}}.</li>
<li>[Topographic and boundary survey of [area] by [survey subconsultant]; SUE to ASCE 38 Quality Level [B] with [number] QL-A test holes.]</li>
<li>[Geotechnical investigation: [number] borings to [depth] feet, laboratory testing, and geotechnical report by [subconsultant].]</li>
<li>[Building projects: field verification of existing structural framing and MEP systems; documentation of equipment nameplate data; [number] site visits.]</li>
</ul>
<h4>Task 3 — Preliminary / Schematic Design (30%)</h4>
<ul>
<li>Design criteria memorandum.</li>
<li>Evaluation of up to [number] alternatives for [key element — e.g., structural system, HVAC system type, pavement section, drainage outfall], with recommendation.</li>
<li>30% plans: [list sheet types — e.g., title, typical sections, plan and profile, drainage layout / structural framing plans / MEP single-line diagrams and equipment schedules].</li>
<li>Engineer's opinion of probable construction cost (OPCC) at 30%.</li>
</ul>
<h4>Task 4 — Design Development (60%)</h4>
<ul>
<li>Refinement of the selected alternative; supporting calculations (hydraulic, structural, load and energy calculations as applicable).</li>
<li>60% plans and technical specification table of contents; updated OPCC.</li>
<li>[Utility coordination: conflict matrix and relocation requests to [number] utility owners.]</li>
</ul>
<h4>Task 5 — Construction Documents (90% and 100%)</h4>
<ul>
<li>90% plans and technical specifications [in CSI MasterFormat / owner format], quantities, and OPCC.</li>
<li>Internal QA/QC and constructability review before each submittal.</li>
<li>100% signed and sealed plans and specifications addressing all 90% review comments, with comment resolution log.</li>
</ul>
<h4>Task 6 — Permitting</h4>
<ul>
<li>[Preparation of permit applications and supporting documents for: building permit (engineering portions), NPDES Construction General Permit / SWPPP, [State] DOT right-of-way or encroachment permit, [local] grading and stormwater permit, [USACE / state environmental], utility and railroad agreements.]</li>
<li>Response to up to [number] rounds of agency comments per permit.</li>
</ul>
<h4>Task 7 — Bid-Phase Services</h4>
<ul>
<li>Attendance at pre-bid meeting; responses to bidder questions; preparation of up to [number] addenda.</li>
<li>Review of bids and letter of recommendation [if requested].</li>
</ul>
<h4>Task 8 — Construction Phase Services</h4>
<ul>
<li>Preconstruction conference.</li>
<li>Review of up to [number] shop drawing and product submittals (including one resubmittal each) and response to up to [number] RFIs.</li>
<li>Up to [number] site observation visits with written field reports, based on a construction duration of [number] months.</li>
<li>Review of contractor change order requests; substantial completion punch list; record drawings based on contractor-provided markups.</li>
</ul>
HTML,
        ],
        [
            'heading' => 'Deliverables by Milestone',
            'tip'     => 'A milestone deliverables table prevents the most common dispute — what "60%" means. Tie each milestone to specific contents and formats (PDF, native CAD/Revit, specifications format). If the client has a CAD standard or expects native files, say so here and price it.',
            'body'    => <<<'HTML'
<table>
<thead><tr><th>Milestone</th><th>Contents</th><th>Format</th><th>Owner Review</th></tr></thead>
<tbody>
<tr><td>30% — Preliminary</td><td>Design criteria memo; alternatives analysis; preliminary plans ([approx. #] sheets); OPCC</td><td>PDF; memo in Word/PDF</td><td>[#] weeks</td></tr>
<tr><td>60% — Design Development</td><td>Developed plans ([approx. #] sheets); calculations; specification table of contents; OPCC; permit application drafts</td><td>PDF; calculations bound PDF</td><td>[#] weeks</td></tr>
<tr><td>90% — Pre-Final</td><td>Complete plans ([approx. #] sheets); technical specifications; quantities; OPCC; comment resolution log</td><td>PDF; specifications in Word</td><td>[#] weeks</td></tr>
<tr><td>100% — Final</td><td>Signed and sealed plans and specifications; final OPCC; bid form quantities</td><td>Sealed PDF; [native [Civil 3D / Revit / MicroStation] files]</td><td>—</td></tr>
<tr><td>Record Drawings</td><td>Plans revised from contractor redlines</td><td>PDF; [native files]</td><td>—</td></tr>
</tbody>
</table>
<p>Deliverables will be prepared to {{client_name}}'s [CAD standards / the architect's BIM Execution Plan at LOD [300/350]]. [Number] hard-copy sets will be provided at [milestone]; additional printing will be billed as a direct expense.</p>
HTML,
        ],
        [
            'heading' => 'Project Team',
            'tip'     => 'Only name people who will actually charge time to the project, and make sure their classifications match the labor-hour matrix. Clients reviewing fee proposals often compare the PM\'s share of hours against the total — too little suggests an absentee PM, too much looks padded.',
            'body'    => <<<'HTML'
<table>
<thead><tr><th>Name</th><th>Role</th><th>Staff Classification</th><th>Registration</th></tr></thead>
<tbody>
<tr><td>[Name]</td><td>Principal-in-Charge</td><td>Principal</td><td>[PE, State]</td></tr>
<tr><td>{{project_manager}}</td><td>Project Manager</td><td>Project Manager</td><td>[PE, State]</td></tr>
<tr><td>[Name]</td><td>[Engineer of Record — Structural / Civil / Mechanical / Electrical]</td><td>Senior Engineer</td><td>[PE/SE, State]</td></tr>
<tr><td>[Name]</td><td>Design Engineer</td><td>Project Engineer / EIT</td><td>[EIT]</td></tr>
<tr><td>[Name]</td><td>CAD / BIM Designer</td><td>Designer / Technician</td><td>—</td></tr>
<tr><td>[Name]</td><td>QA/QC Reviewer</td><td>Senior Engineer</td><td>[PE, State]</td></tr>
<tr><td>[Subconsultant firm]</td><td>[Survey / Geotechnical / Environmental]</td><td>Subconsultant</td><td>[PLS / PE]</td></tr>
</tbody>
</table>
<p>{{firm_name}} firm registration / Certificate of Authorization: {{license_number}}.</p>
HTML,
        ],
        [
            'heading' => 'Labor-Hour Matrix',
            'tip'     => 'Build the matrix bottom-up (sheets × hours per sheet, calculations, meetings) and then compare to a top-down check such as fee as a percent of construction cost for similar projects. Public agencies will audit this against their independent estimate, so every row must be defensible. Attach the native spreadsheet if the client asks; make sure hidden rows and formulas do not reveal anything you did not intend.',
            'body'    => <<<'HTML'
<p>The table below summarizes estimated hours by task and staff classification. A detailed breakdown by subtask and sheet is [attached as Exhibit A / available on request].</p>
<table>
<thead><tr><th>Task</th><th>Principal</th><th>Project Manager</th><th>Senior Engineer</th><th>Project Engineer / EIT</th><th>Designer / CAD-BIM</th><th>Admin</th><th>Total Hours</th><th>Labor Cost</th></tr></thead>
<tbody>
<tr><td>1. Project Management and Meetings</td><td>[#]</td><td>[#]</td><td>[#]</td><td>[#]</td><td>[#]</td><td>[#]</td><td>[#]</td><td>$[amount]</td></tr>
<tr><td>2. Data Collection / Existing Conditions</td><td>[#]</td><td>[#]</td><td>[#]</td><td>[#]</td><td>[#]</td><td>[#]</td><td>[#]</td><td>$[amount]</td></tr>
<tr><td>3. Preliminary Design (30%)</td><td>[#]</td><td>[#]</td><td>[#]</td><td>[#]</td><td>[#]</td><td>[#]</td><td>[#]</td><td>$[amount]</td></tr>
<tr><td>4. Design Development (60%)</td><td>[#]</td><td>[#]</td><td>[#]</td><td>[#]</td><td>[#]</td><td>[#]</td><td>[#]</td><td>$[amount]</td></tr>
<tr><td>5. Construction Documents (90%/100%)</td><td>[#]</td><td>[#]</td><td>[#]</td><td>[#]</td><td>[#]</td><td>[#]</td><td>[#]</td><td>$[amount]</td></tr>
<tr><td>6. Permitting</td><td>[#]</td><td>[#]</td><td>[#]</td><td>[#]</td><td>[#]</td><td>[#]</td><td>[#]</td><td>$[amount]</td></tr>
<tr><td>7. Bid-Phase Services</td><td>[#]</td><td>[#]</td><td>[#]</td><td>[#]</td><td>[#]</td><td>[#]</td><td>[#]</td><td>$[amount]</td></tr>
<tr><td>8. Construction Phase Services</td><td>[#]</td><td>[#]</td><td>[#]</td><td>[#]</td><td>[#]</td><td>[#]</td><td>[#]</td><td>$[amount]</td></tr>
<tr><td>QA/QC (all milestones)</td><td>[#]</td><td>[#]</td><td>[#]</td><td>[#]</td><td>[#]</td><td>[#]</td><td>[#]</td><td>$[amount]</td></tr>
<tr><td><strong>Total Hours</strong></td><td><strong>[#]</strong></td><td><strong>[#]</strong></td><td><strong>[#]</strong></td><td><strong>[#]</strong></td><td><strong>[#]</strong></td><td><strong>[#]</strong></td><td><strong>[#]</strong></td><td></td></tr>
<tr><td><strong>Billing Rate ($/hr)</strong></td><td>$[rate]</td><td>$[rate]</td><td>$[rate]</td><td>$[rate]</td><td>$[rate]</td><td>$[rate]</td><td></td><td></td></tr>
<tr><td><strong>Total Labor</strong></td><td>$[amount]</td><td>$[amount]</td><td>$[amount]</td><td>$[amount]</td><td>$[amount]</td><td>$[amount]</td><td></td><td><strong>$[amount]</strong></td></tr>
</tbody>
</table>
<p>Staff mix: Principal and Project Manager hours represent [##]% of total hours; production staff (Project Engineer and Designer) represent [##]%.</p>
HTML,
        ],
        [
            'heading' => 'Rate Schedule and Multiplier',
            'tip'     => 'Use the method the client expects. Private clients usually see fully loaded hourly billing rates. Public agencies, and especially state DOTs and federal work, often require raw (direct) salary rates × audited overhead (indirect cost rate per FAR Part 31) + a separately negotiated fixed fee or profit. Never mix methods within one proposal, and state when rates escalate.',
            'body'    => <<<'HTML'
<p><strong>Option A — Hourly billing rates (private / architect clients).</strong> Fees are based on {{firm_name}}'s standard hourly billing rates in effect for [year], shown below. Rates include salary, fringe benefits, overhead, and profit, and will be adjusted [annually on January 1 / on the contract anniversary] by no more than [#]% unless otherwise agreed.</p>
<table>
<thead><tr><th>Staff Classification</th><th>Hourly Billing Rate</th></tr></thead>
<tbody>
<tr><td>Principal</td><td>$[rate]</td></tr>
<tr><td>Project Manager</td><td>$[rate]</td></tr>
<tr><td>Senior Engineer [PE/SE]</td><td>$[rate]</td></tr>
<tr><td>Project Engineer</td><td>$[rate]</td></tr>
<tr><td>Engineer-in-Training (EIT)</td><td>$[rate]</td></tr>
<tr><td>Senior Designer / BIM Manager</td><td>$[rate]</td></tr>
<tr><td>Designer / CAD Technician</td><td>$[rate]</td></tr>
<tr><td>Construction Observer / Inspector</td><td>$[rate]</td></tr>
<tr><td>Administrative</td><td>$[rate]</td></tr>
</tbody>
</table>
<p><strong>Option B — Direct labor × multiplier (public agency / DOT format).</strong> Compensation is calculated as follows:</p>
<table>
<thead><tr><th>Component</th><th>Basis</th><th>Value</th></tr></thead>
<tbody>
<tr><td>Direct labor (raw salary rate)</td><td>Actual hourly salary of each individual or classification average, excluding fringe</td><td>$[amount] total</td></tr>
<tr><td>Overhead (indirect cost rate), including fringe</td><td>[Audited / provisional] rate per FAR Part 31, [audit agency and fiscal year]</td><td>[###.##]% of direct labor</td></tr>
<tr><td>Subtotal: direct labor + overhead</td><td>—</td><td>$[amount]</td></tr>
<tr><td>Fixed fee / profit</td><td>[##]% of direct labor + overhead, as negotiated</td><td>$[amount]</td></tr>
<tr><td>Effective multiplier on direct labor</td><td>(1 + overhead rate) × (1 + profit rate)</td><td>[#.##]</td></tr>
</tbody>
</table>
<p>[Example: a direct salary of $[##.##]/hour × (1 + [###]% overhead) × (1 + [##]% profit) = $[###.##]/hour billed.] Salary escalation for work extending beyond [date] is included at [#]% per year.</p>
HTML,
        ],
        [
            'heading' => 'Subconsultant Fees',
            'tip'     => 'Attach each subconsultant\'s signed proposal so the client can see their scope and assumptions match yours. Markup on subconsultants (to cover administration, coordination, and your liability) is common on private work; many public agencies cap or prohibit it — check before adding. Note DBE status here if participation is tracked.',
            'body'    => <<<'HTML'
<table>
<thead><tr><th>Subconsultant</th><th>Discipline / Scope</th><th>Tasks</th><th>DBE/SBE Status</th><th>Fee</th></tr></thead>
<tbody>
<tr><td>[Firm name]</td><td>[Topographic and boundary survey]</td><td>[2]</td><td>[Certified DBE — [State] UCP / N/A]</td><td>$[amount]</td></tr>
<tr><td>[Firm name]</td><td>[Geotechnical investigation and report]</td><td>[2, 4]</td><td>[Status]</td><td>$[amount]</td></tr>
<tr><td>[Firm name]</td><td>[Subsurface utility engineering]</td><td>[2]</td><td>[Status]</td><td>$[amount]</td></tr>
<tr><td>[Firm name]</td><td>[Environmental / landscape / traffic / fire protection / specialty]</td><td>[#]</td><td>[Status]</td><td>$[amount]</td></tr>
<tr><td><strong>Subtotal</strong></td><td></td><td></td><td></td><td><strong>$[amount]</strong></td></tr>
<tr><td>Administrative markup ([#]%) [delete if not permitted]</td><td></td><td></td><td></td><td>$[amount]</td></tr>
<tr><td><strong>Total Subconsultant Fees</strong></td><td></td><td></td><td></td><td><strong>$[amount]</strong></td></tr>
</tbody>
</table>
<p>Subconsultant proposals are attached as [Exhibit B]. {{firm_name}} will manage subconsultant scope, schedule, and quality, and will review subconsultant deliverables before submittal to {{client_name}}.</p>
HTML,
        ],
        [
            'heading' => 'Direct Expenses (Reimbursables)',
            'tip'     => 'Either include expenses in the lump sum or list them as reimbursable with a not-to-exceed budget — say which. Use the current IRS or agency mileage rate rather than a made-up figure, and separate pass-through costs (permit and application fees, lab testing) that the client may prefer to pay directly.',
            'body'    => <<<'HTML'
<table>
<thead><tr><th>Expense</th><th>Basis</th><th>Estimated Quantity</th><th>Estimated Cost</th></tr></thead>
<tbody>
<tr><td>Mileage</td><td>[Current IRS / agency rate] per mile</td><td>[#] miles</td><td>$[amount]</td></tr>
<tr><td>Travel and lodging [if applicable]</td><td>[Actual cost / GSA per diem]</td><td>[#] trips</td><td>$[amount]</td></tr>
<tr><td>Printing and plotting</td><td>$[rate] per sheet / at cost</td><td>[#] sets</td><td>$[amount]</td></tr>
<tr><td>Courier and shipping</td><td>At cost</td><td>—</td><td>$[amount]</td></tr>
<tr><td>Laboratory testing [if not in subconsultant fee]</td><td>Unit rates</td><td>[#] tests</td><td>$[amount]</td></tr>
<tr><td>Traffic control for field work</td><td>At cost</td><td>[#] days</td><td>$[amount]</td></tr>
<tr><td>Permit and application fees (pass-through)</td><td>At cost, no markup</td><td>—</td><td>$[amount / paid directly by owner]</td></tr>
<tr><td><strong>Total Direct Expenses</strong></td><td></td><td></td><td><strong>$[amount]</strong></td></tr>
</tbody>
</table>
<p>Direct expenses will be billed [at cost / at cost plus [#]%] with receipts available on request, and will not exceed the budget above without {{client_name}}'s written approval.</p>
HTML,
        ],
        [
            'heading' => 'Fee Summary',
            'tip'     => 'This table is what gets pasted into the board memo or the architect\'s fee proposal, so make it stand alone. Show the compensation type by task — mixing lump sum for design with hourly NTE for construction phase services is common and fair, because construction duration and contractor behavior are outside your control.',
            'body'    => <<<'HTML'
<table>
<thead><tr><th>Task</th><th>Compensation Method</th><th>Labor</th><th>Subconsultants</th><th>Expenses</th><th>Task Total</th></tr></thead>
<tbody>
<tr><td>1. Project Management and Meetings</td><td>[Lump sum]</td><td>$[amount]</td><td>$[amount]</td><td>$[amount]</td><td>$[amount]</td></tr>
<tr><td>2. Data Collection / Existing Conditions</td><td>[Lump sum]</td><td>$[amount]</td><td>$[amount]</td><td>$[amount]</td><td>$[amount]</td></tr>
<tr><td>3. Preliminary Design (30%)</td><td>[Lump sum]</td><td>$[amount]</td><td>$[amount]</td><td>$[amount]</td><td>$[amount]</td></tr>
<tr><td>4. Design Development (60%)</td><td>[Lump sum]</td><td>$[amount]</td><td>$[amount]</td><td>$[amount]</td><td>$[amount]</td></tr>
<tr><td>5. Construction Documents (90%/100%)</td><td>[Lump sum]</td><td>$[amount]</td><td>$[amount]</td><td>$[amount]</td><td>$[amount]</td></tr>
<tr><td>6. Permitting</td><td>[Lump sum]</td><td>$[amount]</td><td>$[amount]</td><td>$[amount]</td><td>$[amount]</td></tr>
<tr><td>7. Bid-Phase Services</td><td>[Hourly NTE]</td><td>$[amount]</td><td>$[amount]</td><td>$[amount]</td><td>$[amount]</td></tr>
<tr><td>8. Construction Phase Services</td><td>[Hourly NTE]</td><td>$[amount]</td><td>$[amount]</td><td>$[amount]</td><td>$[amount]</td></tr>
<tr><td><strong>Total Fee</strong></td><td></td><td><strong>$[amount]</strong></td><td><strong>$[amount]</strong></td><td><strong>$[amount]</strong></td><td><strong>{{total_fee}}</strong></td></tr>
</tbody>
</table>
<p>Optional services, priced separately and performed only on written authorization:</p>
<ul>
<li>[Additional design alternative] — $[amount]</li>
<li>[Additional construction site visit] — $[amount] each</li>
<li>[Energy modeling] — $[amount]</li>
<li>[Special inspections] — hourly per the rate schedule</li>
</ul>
HTML,
        ],
        [
            'heading' => 'Assumptions',
            'tip'     => 'Assumptions are your change-order insurance. Every number here — review cycles, meetings, sheet count, construction duration — should be one you would point to when requesting additional services. If you had to guess at something during scoping, write the guess down here.',
            'body'    => <<<'HTML'
<p>This proposal is based on the following assumptions. Changes to these assumptions may require an adjustment to scope, schedule, and fee, which we will discuss with {{client_name}} before proceeding.</p>
<ol>
<li>{{client_name}} will provide [record drawings, GIS data, prior studies, title reports, and owner design standards] within [#] days of Notice to Proceed, and {{firm_name}} may rely on the accuracy of owner-furnished information.</li>
<li>Design will proceed on the basis of one approved alternative selected at the 30% milestone. Evaluation of additional alternatives or redesign after approval of a milestone is an additional service.</li>
<li>{{client_name}} will provide consolidated review comments within [#] business days of each submittal. One round of review is included per milestone.</li>
<li>The plan set is estimated at approximately [#] sheets. [Structural and MEP: based on the architect's floor plans being substantially complete at the start of our design development.]</li>
<li>Meetings are limited to those listed in Task 1; [#] meetings are assumed in person and the remainder virtual.</li>
<li>Geotechnical recommendations will be provided by [subconsultant / the owner's geotechnical engineer] and are assumed not to require deep foundations or ground improvement. [Revise as appropriate.]</li>
<li>Right-of-way acquisition, easement documents, and legal descriptions [are / are not] included.</li>
<li>The project will be bid as a single construction package in [year]. Phased or multiple bid packages are an additional service.</li>
<li>Construction phase services assume a construction duration of [#] months, [#] site visits, [#] RFIs, and [#] submittals.</li>
<li>Work will be performed during normal business hours; no after-hours or weekend field work is assumed except [describe].</li>
<li>[Federal/state funding: the project is [not] subject to federal-aid requirements beyond those described in this proposal.]</li>
</ol>
HTML,
        ],
        [
            'heading' => 'Exclusions',
            'tip'     => 'Be explicit about the services clients commonly assume are included. For MEP consultants, energy modeling, commissioning, and low-voltage/security are frequent gaps; for structural, special inspections, delegated design, and existing building evaluation; for civil, traffic studies, wetlands, and off-site improvements. Exclusions protect both parties — they are not a negotiation tactic.',
            'body'    => <<<'HTML'
<p>The following services are not included in this proposal. {{firm_name}} can provide many of them as additional services upon written authorization.</p>
<ul>
<li>Permit, plan review, impact, connection, and application fees (paid by {{client_name}}).</li>
<li>Environmental site assessments, hazardous materials surveys, and remediation design.</li>
<li>Wetland delineation, threatened and endangered species surveys, and cultural resource studies [unless listed in scope].</li>
<li>Traffic impact studies and off-site improvements beyond the project limits.</li>
<li>Special inspections and construction materials testing.</li>
<li>Full-time resident project representation or construction inspection.</li>
<li>Design of contractor-delegated systems (e.g., [pre-engineered metal buildings, trusses, fire sprinkler hydraulic design, shoring, temporary works]) beyond review for general conformance.</li>
<li>[MEP: energy modeling, building commissioning, LEED/WELL documentation, audiovisual, security, and low-voltage systems design.]</li>
<li>[Structural: evaluation of existing structures outside the project area; seismic evaluation of existing buildings unless required by code for this scope.]</li>
<li>Expert witness services, litigation support, and redesign resulting from changes in owner requirements or code changes after design approval.</li>
<li>Construction cost estimating beyond the OPCC described in the scope; {{firm_name}} does not guarantee that bids or construction costs will not vary from its opinions of probable cost.</li>
</ul>
HTML,
        ],
        [
            'heading' => 'Schedule',
            'tip'     => 'Express the schedule in weeks from Notice to Proceed and separate your time from the owner\'s review time and agency permit time. That way a late owner review does not become your late delivery. Call out any long-lead items (utility responses, permits, geotech drilling) that drive the critical path.',
            'body'    => <<<'HTML'
<table>
<thead><tr><th>Milestone</th><th>Responsible</th><th>Duration</th><th>Weeks After NTP</th></tr></thead>
<tbody>
<tr><td>Notice to Proceed / Kickoff</td><td>{{client_name}} / {{firm_name}}</td><td>—</td><td>0</td></tr>
<tr><td>Survey, SUE, geotechnical complete</td><td>{{firm_name}} and subconsultants</td><td>[#] weeks</td><td>[#]</td></tr>
<tr><td>30% submittal</td><td>{{firm_name}}</td><td>[#] weeks</td><td>[#]</td></tr>
<tr><td>30% review</td><td>{{client_name}}</td><td>[#] weeks</td><td>[#]</td></tr>
<tr><td>60% submittal / permit applications</td><td>{{firm_name}}</td><td>[#] weeks</td><td>[#]</td></tr>
<tr><td>60% review</td><td>{{client_name}}</td><td>[#] weeks</td><td>[#]</td></tr>
<tr><td>90% submittal</td><td>{{firm_name}}</td><td>[#] weeks</td><td>[#]</td></tr>
<tr><td>90% review</td><td>{{client_name}}</td><td>[#] weeks</td><td>[#]</td></tr>
<tr><td>100% sealed documents</td><td>{{firm_name}}</td><td>[#] weeks</td><td>[#]</td></tr>
<tr><td>Permit approvals</td><td>Agencies</td><td>[#] weeks (estimated)</td><td>[#]</td></tr>
<tr><td>Bidding</td><td>{{client_name}}</td><td>[#] weeks</td><td>[#]</td></tr>
<tr><td>Construction phase services</td><td>{{firm_name}}</td><td>[#] months</td><td>[#]–[#]</td></tr>
</tbody>
</table>
<p>{{firm_name}} will not be responsible for delays caused by owner review periods exceeding those shown, agency permit reviews, or other circumstances beyond our reasonable control; the schedule will be adjusted accordingly.</p>
HTML,
        ],
        [
            'heading' => 'Terms and Conditions',
            'tip'     => 'For larger projects, reference an industry-standard agreement (EJCDC E-500 for owner-engineer, AIA C401 or ConsensusDocs 240/245 for engineer as consultant to an architect) instead of writing your own. If the client will issue their own contract, state that this proposal will be incorporated and flag any terms you need to negotiate — especially indemnity, standard of care, and limitation of liability.',
            'body'    => <<<'HTML'
<ol>
<li><strong>Agreement.</strong> Services will be performed under the following agreement: [owner's standard professional services agreement with this proposal incorporated as the scope of services / EJCDC E-500 / AIA C401 / the terms below].</li>
<li><strong>Standard of care.</strong> Services will be performed with the degree of skill and care ordinarily exercised by licensed professional engineers practicing under similar circumstances at the same time and in the same locality. No other warranty, express or implied, is made.</li>
<li><strong>Invoicing and payment.</strong> Invoices will be submitted monthly based on percent complete for lump-sum tasks and hours worked for hourly tasks. Payment is due within [30] days of invoice. Balances unpaid after [#] days accrue interest at [#]% per month [or the maximum allowed by law]. {{firm_name}} may suspend services upon [#] days' written notice if invoices remain unpaid.</li>
<li><strong>Additional services.</strong> Services beyond this scope, or changes to the assumptions above, will be performed only on written authorization at the rates in this proposal or a negotiated lump sum.</li>
<li><strong>Opinions of probable construction cost.</strong> Opinions of cost are based on our professional judgment and experience. {{firm_name}} has no control over market conditions or contractor pricing and does not guarantee that bids or actual costs will not vary from our opinions.</li>
<li><strong>Construction phase.</strong> {{firm_name}} will not supervise, direct, or control the contractor's work, means, methods, sequences, or safety programs, and is not responsible for the contractor's failure to perform in accordance with the contract documents.</li>
<li><strong>Instruments of service.</strong> Drawings, specifications, and electronic files are instruments of service. {{client_name}} may use them for this project; reuse or modification for other purposes without {{firm_name}}'s written consent is at {{client_name}}'s sole risk. Electronic files are provided for convenience; the sealed documents govern.</li>
<li><strong>Insurance.</strong> {{firm_name}} maintains professional liability insurance of $[amount] per claim / $[amount] aggregate, commercial general liability of $[amount], automobile liability, and workers' compensation at statutory limits.</li>
<li><strong>Limitation of liability.</strong> To the extent permitted by law, {{firm_name}}'s total liability for claims arising from this agreement is limited to [the fee / $amount / available insurance proceeds — delete or revise per client contract and counsel review].</li>
<li><strong>Termination.</strong> Either party may terminate on [#] days' written notice. {{firm_name}} will be paid for services performed and reimbursable expenses incurred through the termination date.</li>
<li><strong>Validity.</strong> This proposal is valid for [60/90] days from {{submittal_date}}. Fees for services performed after [date] are subject to escalation at [#]% per year.</li>
</ol>
HTML,
        ],
        [
            'heading' => 'Authorization and Acceptance',
            'tip'     => 'Make it easy to say yes: a single signature block that authorizes the work and incorporates the terms. Ask for a purchase order or contract number if the client uses one, and do not start billable work until you have signed authorization — verbal notice to proceed is the source of many unpaid invoices.',
            'body'    => <<<'HTML'
<p>If this proposal is acceptable, please sign below and return a copy to {{firm_name}}. Your signature authorizes {{firm_name}} to proceed with the services described for {{project_name}} for a total fee of {{total_fee}}, in accordance with the scope, assumptions, exclusions, and terms of this proposal.</p>
<table>
<thead><tr><th>Submitted by: {{firm_name}}</th><th>Accepted by: {{client_name}}</th></tr></thead>
<tbody>
<tr><td>Signature: ______________________________</td><td>Signature: ______________________________</td></tr>
<tr><td>Name: {{contact_name}}</td><td>Name: ______________________________</td></tr>
<tr><td>Title: {{contact_title}}</td><td>Title: ______________________________</td></tr>
<tr><td>Date: {{submittal_date}}</td><td>Date: ______________________________</td></tr>
<tr><td>Phone / Email: {{firm_phone}} / {{firm_email}}</td><td>Purchase Order / Contract No.: ______________________________</td></tr>
</tbody>
</table>
<p><strong>Billing contact (if different):</strong> [Name, email, phone, invoice submission instructions]</p>
<p><strong>Attachments:</strong> [Exhibit A — Detailed Labor-Hour Estimate; Exhibit B — Subconsultant Proposals; Exhibit C — Rate Schedule; Exhibit D — Standard Terms and Conditions]</p>
HTML,
        ],
    ],
];
