<?php
if (!defined('ABSPATH')) exit;

return [
    'slug'     => 'construction-bid-proposal',
    'title'    => 'Construction Bid / GMP Proposal',
    'industry' => 'construction',
    'type'     => 'proposal',
    'summary'  => 'A general contractor\'s priced proposal that works for a lump-sum bid or a CM at-risk Guaranteed Maximum Price: pricing summary, CSI division breakdown, general conditions, fee, contingency, allowances, alternates, unit prices, clarifications and exclusions, schedule, logistics, bonds, and acceptance.',
    'use_when' => [
        'Submitting a lump-sum (stipulated sum) proposal on a negotiated or invited private project',
        'Presenting a GMP at the end of preconstruction under a CM at-risk agreement (e.g., AIA A133 / ConsensusDocs 500)',
        'Pricing a tenant improvement, renovation, or addition for an owner, developer, or property manager',
        'Formalizing a budget or hard number after design is complete enough to price with trade bids',
    ],
    'length'   => '8–20 pages plus estimate backup and drawing/specification list',

    'fields' => [
        'firm_name'          => 'Your company name',
        'contact_name'       => 'Your name',
        'contact_title'      => 'Your title',
        'firm_phone'         => 'Phone',
        'firm_email'         => 'Email',
        'firm_address'       => 'Office address',
        'firm_website'       => 'Website',
        'license_number'     => 'License number(s)',
        'client_name'        => 'Client / owner name',
        'client_contact'     => 'Client contact person',
        'project_name'       => 'Project name',
        'project_location'   => 'Project address or location',
        'submittal_date'     => 'Submittal date',
        'architect_name'     => 'Architect / engineer of record',
        'proposal_total'     => 'Total proposal amount (lump sum or GMP)',
        'proposal_valid_days'=> 'Proposal valid for (days)',
        'project_manager'    => 'Project manager name',
        'superintendent'     => 'Superintendent name',
    ],

    'checklist' => [
        'Drawing and specification list matches the exact set you priced, including revision dates and every addendum',
        'CSI division totals, general conditions, fee, contingency, bonds, and insurance add up to the proposal total with no rounding errors',
        'Fee and insurance/bond markups calculated on the correct base as defined in the contract (e.g., fee on cost of work vs. on cost plus GCs)',
        'Every allowance has a stated amount and a clear description of what it covers (material only vs. furnish and install)',
        'Alternates are numbered to match the bid documents and stated as add or deduct, with schedule impact noted',
        'Unit prices include units of measure and whether they include overhead and profit',
        'Clarifications and exclusions reviewed against the scope sheets of the low subcontractors you carried — no gaps between trades',
        'Scope of owner-furnished items (FF&E, low voltage, testing, permits, utility fees) is stated clearly',
        'Schedule duration and substantial completion date are realistic against current long-lead equipment times',
        'Material escalation risk addressed (escalation clause, price hold dates, or contingency) for volatile items',
        'Bond premium and builder\'s risk are included or excluded explicitly',
        'Sales/use tax and prevailing wage status confirmed and stated',
        'Proposal validity period is stated and aligned with subcontractor bid validity',
        'Signed by an officer authorized to bind the company, with license number shown',
        'Estimate backup (bid tabulation, GC breakdown) ready to share if the contract is open book',
    ],

    'sections' => [
        [
            'heading' => 'Cover Letter',
            'tip'     => 'State the number, what it buys, and how long it is good for in the first paragraph — owners and lenders read that first. Identify the document set you priced by date and addenda; almost every scope dispute traces back to an ambiguous basis of pricing. Keep it to one page.',
            'body'    => <<<'HTML'
<p>{{submittal_date}}</p>
<p>{{client_contact}}<br>{{client_name}}<br>[Owner address]</p>
<p><strong>Re: [Lump Sum / Guaranteed Maximum Price] Proposal — {{project_name}}, {{project_location}}</strong></p>
<p>Dear {{client_contact}},</p>
<p>{{firm_name}} is pleased to submit our [lump-sum / Guaranteed Maximum Price (GMP)] proposal of <strong>{{proposal_total}}</strong> for the construction of {{project_name}}. This proposal is based on the [Construction Documents / 100% CD set / GMP set] prepared by {{architect_name}}, dated [MM/DD/YYYY], and Addenda [No. 1 through No. X], as listed in the Basis of Proposal section.</p>
<p>Our price includes [all labor, material, equipment, supervision, general conditions, insurance, and fee] to complete the work described, with a construction duration of [number] calendar days from Notice to Proceed and substantial completion on or before [MM/DD/YYYY], subject to the clarifications herein.</p>
<p>[For a GMP: The GMP was developed through [number] months of preconstruction with {{client_name}} and {{architect_name}}. It reflects competitive bids from [number] subcontractors across [number] trade packages, with [X]% of the cost of work bought out on firm bids.]</p>
<p>This proposal is valid for {{proposal_valid_days}} days from the date above. We look forward to building {{project_name}} with you. Please contact me at {{firm_phone}} or {{firm_email}} with any questions.</p>
<p>Sincerely,</p>
<p>{{contact_name}}<br>{{contact_title}}<br>{{firm_name}}<br>License: {{license_number}}</p>
HTML,
        ],
        [
            'heading' => 'Basis of Proposal',
            'tip'     => 'This list defines your contract scope — if a drawing or addendum is not listed, you did not price it. Include every sheet number with revision date (or attach a sheet index as an exhibit) and every spec section. For a GMP, this becomes the "GMP documents" exhibit in the amendment, so be exact.',
            'body'    => <<<'HTML'
<p>This proposal is based on the following documents:</p>
<table>
<thead>
<tr><th>Document</th><th>Prepared by</th><th>Date / revision</th></tr>
</thead>
<tbody>
<tr><td>Drawings — [Civil, Architectural, Structural, Mechanical, Plumbing, Electrical, Fire Protection] — see Exhibit [A] sheet index</td><td>{{architect_name}}</td><td>[MM/DD/YYYY]</td></tr>
<tr><td>Project Manual / Specifications, Divisions [00] through [33]</td><td>{{architect_name}}</td><td>[MM/DD/YYYY]</td></tr>
<tr><td>Addendum No. [1]</td><td>{{architect_name}}</td><td>[MM/DD/YYYY]</td></tr>
<tr><td>Addendum No. [2]</td><td>{{architect_name}}</td><td>[MM/DD/YYYY]</td></tr>
<tr><td>Geotechnical report</td><td>[Geotechnical engineer]</td><td>[MM/DD/YYYY]</td></tr>
<tr><td>[Hazardous materials survey / environmental report]</td><td>[Consultant]</td><td>[MM/DD/YYYY]</td></tr>
<tr><td>[Owner design standards / tenant criteria]</td><td>[Owner]</td><td>[MM/DD/YYYY]</td></tr>
</tbody>
</table>
<ul>
<li><strong>Contract form:</strong> [AIA A101 Stipulated Sum / AIA A102 Cost of Work plus Fee with GMP / AIA A133 CM as Constructor with GMP / ConsensusDocs 200 or 500 / owner's form], with [AIA A201 General Conditions], modified as mutually agreed</li>
<li><strong>Delivery method:</strong> [Design-bid-build lump sum / CM at-risk GMP / negotiated lump sum]</li>
<li><strong>Labor basis:</strong> [Open shop / union / prevailing wage per (agency) determination No. (X)]</li>
<li><strong>Sales tax:</strong> [Included / excluded — project is tax-exempt per owner certificate]</li>
<li><strong>Site visit:</strong> Conducted by {{firm_name}} on [MM/DD/YYYY]</li>
</ul>
HTML,
        ],
        [
            'heading' => 'Pricing Summary',
            'tip'     => 'Put the whole number on one page so it can be dropped into a contract exhibit. For a lump sum, owners mostly care about the total and the alternates; for a GMP, they will scrutinize each line — especially general conditions, contingency, and how fee is calculated. Typical CM at-risk fees run roughly 2–6% depending on project size and market; state your basis instead of just a number.',
            'body'    => <<<'HTML'
<table>
<thead>
<tr><th>Line</th><th>Description</th><th>Amount</th></tr>
</thead>
<tbody>
<tr><td>1</td><td>Cost of the Work — trade subcontracts and self-performed work (see CSI breakdown)</td><td>$[amount]</td></tr>
<tr><td>2</td><td>Allowances (see Allowances schedule)</td><td>$[amount]</td></tr>
<tr><td>3</td><td>General Conditions / General Requirements (see breakdown)</td><td>$[amount]</td></tr>
<tr><td>4</td><td>Construction Contingency ([X]% of Lines 1–3) [GMP only]</td><td>$[amount]</td></tr>
<tr><td>5</td><td>Escalation Contingency [if carried]</td><td>$[amount]</td></tr>
<tr><td></td><td><strong>Subtotal — Cost of Work</strong></td><td><strong>$[amount]</strong></td></tr>
<tr><td>6</td><td>General Liability Insurance ([X]% of subtotal)</td><td>$[amount]</td></tr>
<tr><td>7</td><td>Builder's Risk Insurance [included / by owner]</td><td>$[amount]</td></tr>
<tr><td>8</td><td>Subcontractor Default Insurance [if used] ([X]% of subcontract value)</td><td>$[amount]</td></tr>
<tr><td>9</td><td>Performance and Payment Bonds ([X]% / per surety schedule)</td><td>$[amount]</td></tr>
<tr><td>10</td><td>Contractor's Fee ([X]% of [Cost of Work / Lines 1–9])</td><td>$[amount]</td></tr>
<tr><td></td><td><strong>TOTAL [LUMP SUM / GUARANTEED MAXIMUM PRICE]</strong></td><td><strong>{{proposal_total}}</strong></td></tr>
</tbody>
</table>
<p>Cost per square foot: $[amount] / SF based on [number] gross square feet.</p>
<p><em>For a GMP only (delete for lump sum):</em> The GMP is the maximum amount {{client_name}} will pay for the Work described, subject to adjustment only by approved Change Order. Savings below the GMP at final accounting will be [returned 100% to the owner / shared [X]% owner / [X]% contractor], as defined in the Agreement.</p>
HTML,
        ],
        [
            'heading' => 'Cost Breakdown by CSI Division',
            'tip'     => 'Use the MasterFormat divisions that match the spec book so the owner can trace every dollar to a spec section; many owners also want the same breakdown as the schedule of values for pay applications. Note which divisions are self-performed and which are based on how many bids. Delete divisions not in the project rather than leaving zeros that invite questions.',
            'body'    => <<<'HTML'
<table>
<thead>
<tr><th>Division</th><th>Description</th><th>Basis (bids received / self-perform / budget)</th><th>Amount</th></tr>
</thead>
<tbody>
<tr><td>01</td><td>General Requirements (project-specific, not in General Conditions)</td><td>[Estimate]</td><td>$[amount]</td></tr>
<tr><td>02</td><td>Existing Conditions — demolition, abatement</td><td>[3 bids]</td><td>$[amount]</td></tr>
<tr><td>03</td><td>Concrete</td><td>[Self-perform]</td><td>$[amount]</td></tr>
<tr><td>04</td><td>Masonry</td><td>[3 bids]</td><td>$[amount]</td></tr>
<tr><td>05</td><td>Metals — structural steel, misc. metals</td><td>[4 bids]</td><td>$[amount]</td></tr>
<tr><td>06</td><td>Wood, Plastics &amp; Composites — rough carpentry, millwork</td><td>[Self-perform / 2 bids]</td><td>$[amount]</td></tr>
<tr><td>07</td><td>Thermal &amp; Moisture Protection — roofing, waterproofing, insulation</td><td>[3 bids]</td><td>$[amount]</td></tr>
<tr><td>08</td><td>Openings — doors, frames, hardware, glazing, curtain wall</td><td>[3 bids]</td><td>$[amount]</td></tr>
<tr><td>09</td><td>Finishes — framing/drywall, ceilings, flooring, paint</td><td>[3 bids each]</td><td>$[amount]</td></tr>
<tr><td>10</td><td>Specialties — toilet accessories, signage, lockers</td><td>[2 bids]</td><td>$[amount]</td></tr>
<tr><td>11</td><td>Equipment</td><td>[Budget]</td><td>$[amount]</td></tr>
<tr><td>12</td><td>Furnishings — window treatments, casework</td><td>[2 bids]</td><td>$[amount]</td></tr>
<tr><td>14</td><td>Conveying Equipment — elevators</td><td>[2 bids]</td><td>$[amount]</td></tr>
<tr><td>21</td><td>Fire Suppression</td><td>[3 bids]</td><td>$[amount]</td></tr>
<tr><td>22</td><td>Plumbing</td><td>[3 bids]</td><td>$[amount]</td></tr>
<tr><td>23</td><td>HVAC</td><td>[3 bids]</td><td>$[amount]</td></tr>
<tr><td>26</td><td>Electrical</td><td>[3 bids]</td><td>$[amount]</td></tr>
<tr><td>27</td><td>Communications — low voltage [if in scope]</td><td>[2 bids]</td><td>$[amount]</td></tr>
<tr><td>28</td><td>Electronic Safety &amp; Security — fire alarm, access control</td><td>[2 bids]</td><td>$[amount]</td></tr>
<tr><td>31</td><td>Earthwork</td><td>[3 bids]</td><td>$[amount]</td></tr>
<tr><td>32</td><td>Exterior Improvements — paving, landscaping, fencing</td><td>[3 bids]</td><td>$[amount]</td></tr>
<tr><td>33</td><td>Utilities — water, sewer, storm</td><td>[3 bids]</td><td>$[amount]</td></tr>
<tr><td></td><td><strong>Total Cost of Work (Line 1)</strong></td><td></td><td><strong>$[amount]</strong></td></tr>
</tbody>
</table>
HTML,
        ],
        [
            'heading' => 'General Conditions',
            'tip'     => 'Define the difference between General Conditions (time-related project staffing and site overhead) and General Requirements (Division 01 items), because owners compare these across bidders and double-counting is a common audit finding. For a GMP, owners increasingly ask for GCs as a fixed lump sum or a not-to-exceed; say which. GCs typically land in the 6–12% range of construction cost depending on duration and project size.',
            'body'    => <<<'HTML'
<p>General Conditions are [a fixed lump sum / a not-to-exceed amount billed at actual cost / billed monthly at $[amount] per month] for a [number]-month construction duration.</p>
<table>
<thead>
<tr><th>Item</th><th>Quantity</th><th>Unit</th><th>Rate</th><th>Amount</th></tr>
</thead>
<tbody>
<tr><td>Project Executive ({{firm_name}})</td><td>[X]</td><td>months at [X]%</td><td>$[rate]</td><td>$[amount]</td></tr>
<tr><td>Project Manager — {{project_manager}}</td><td>[X]</td><td>months</td><td>$[rate]</td><td>$[amount]</td></tr>
<tr><td>Superintendent — {{superintendent}}</td><td>[X]</td><td>months</td><td>$[rate]</td><td>$[amount]</td></tr>
<tr><td>Assistant Superintendent</td><td>[X]</td><td>months</td><td>$[rate]</td><td>$[amount]</td></tr>
<tr><td>Project Engineer</td><td>[X]</td><td>months</td><td>$[rate]</td><td>$[amount]</td></tr>
<tr><td>Safety Manager (part-time)</td><td>[X]</td><td>months at [X]%</td><td>$[rate]</td><td>$[amount]</td></tr>
<tr><td>Field office trailer, furniture, utilities</td><td>[X]</td><td>months</td><td>$[rate]</td><td>$[amount]</td></tr>
<tr><td>Temporary toilets, water, power, and heat</td><td>[X]</td><td>months</td><td>$[rate]</td><td>$[amount]</td></tr>
<tr><td>Temporary fencing, barricades, signage</td><td>[X]</td><td>LS</td><td>$[rate]</td><td>$[amount]</td></tr>
<tr><td>Dumpsters and waste hauling / recycling</td><td>[X]</td><td>pulls</td><td>$[rate]</td><td>$[amount]</td></tr>
<tr><td>Progress and final cleaning</td><td>[X]</td><td>LS</td><td>$[rate]</td><td>$[amount]</td></tr>
<tr><td>Hoisting / crane [if not in trade scopes]</td><td>[X]</td><td>months</td><td>$[rate]</td><td>$[amount]</td></tr>
<tr><td>Project management software, printing, IT</td><td>[X]</td><td>months</td><td>$[rate]</td><td>$[amount]</td></tr>
<tr><td>Survey and layout</td><td>[X]</td><td>LS</td><td>$[rate]</td><td>$[amount]</td></tr>
<tr><td>Small tools and consumables</td><td>[X]</td><td>LS</td><td>$[rate]</td><td>$[amount]</td></tr>
<tr><td></td><td></td><td></td><td><strong>Total General Conditions</strong></td><td><strong>$[amount]</strong></td></tr>
</tbody>
</table>
<p>Staff labor rates include [salary, payroll taxes, benefits, and vehicle allowance] at the rates in Exhibit [X].</p>
HTML,
        ],
        [
            'heading' => 'Fee & Contingency',
            'tip'     => 'Spell out exactly what the fee is a percentage of, and what the fee is applied to on change orders — this is one of the most-negotiated items in a GMP. For contingency, define who controls it, what it may be used for (e.g., buyout gaps, coordination issues — not owner scope changes), how use is reported, and what happens to the unused balance. Typical CM contingency ranges from about 2–5% depending on design completeness.',
            'body'    => <<<'HTML'
<h4>Contractor's Fee</h4>
<p>The Contractor's Fee is [X]% of the [Cost of the Work, including General Conditions / Cost of the Work plus insurance and bonds]. The same percentage will apply to additive and deductive Change Orders [or: additive Change Orders only; deductive Change Orders adjust fee by (X)%]. The fee covers [home-office overhead, executive oversight beyond that listed in General Conditions, and profit].</p>
<h4>Construction Contingency [GMP only]</h4>
<p>The GMP includes a Construction Contingency of $[amount] ([X]% of the Cost of the Work). The Contingency is for {{firm_name}}'s use, with notice to {{client_name}}, to cover costs within the scope of the GMP documents that could not be reasonably anticipated, including:</p>
<ul>
<li>Scope gaps between subcontract packages discovered after buyout</li>
<li>Subcontractor default or bid errors not recoverable from the subcontractor or its surety</li>
<li>Coordination issues among trades and minor field conditions within the design intent</li>
<li>Overtime or acceleration to recover schedule for which {{firm_name}} is responsible</li>
</ul>
<p>The Contingency will not be used for owner-directed scope changes, which will be handled by Change Order. Contingency use will be reported [monthly] in a contingency log with each transfer described. Unused Contingency at final accounting will be [returned to the owner / shared per the savings clause].</p>
<h4>Owner's Contingency (recommended, not included)</h4>
<p>We recommend {{client_name}} carry a separate owner's contingency of [X]–[X]% for design changes, unforeseen conditions, and owner-requested scope, which is outside this proposal.</p>
HTML,
        ],
        [
            'heading' => 'Allowances',
            'tip'     => 'Allowances are for items that are known to exist but not yet defined. State whether each covers material only or furnish and install, and whether overhead, profit, and GCs sit inside or outside the allowance (AIA A201 §3.8 assumes costs to the contractor for unloading, handling, labor, and installation are in the contract sum, not the allowance, unless stated otherwise). Too many or too-low allowances look like an incomplete price — owners notice.',
            'body'    => <<<'HTML'
<table>
<thead>
<tr><th>No.</th><th>Description</th><th>Includes</th><th>Amount</th></tr>
</thead>
<tbody>
<tr><td>A-1</td><td>[Rock excavation beyond geotechnical report assumptions]</td><td>[Labor, equipment, and disposal]</td><td>$[amount]</td></tr>
<tr><td>A-2</td><td>[Unsuitable soils removal and replacement]</td><td>[Furnish and install]</td><td>$[amount]</td></tr>
<tr><td>A-3</td><td>[Signage — exterior monument and building signage]</td><td>[Furnish and install]</td><td>$[amount]</td></tr>
<tr><td>A-4</td><td>[Finish hardware]</td><td>[Material only; installation included in base]</td><td>$[amount]</td></tr>
<tr><td>A-5</td><td>[Utility company connection fees]</td><td>[Fees only]</td><td>$[amount]</td></tr>
<tr><td>A-6</td><td>[Owner-selected finishes — flooring, tile]</td><td>[Material at $[X]/SF]</td><td>$[amount]</td></tr>
<tr><td></td><td><strong>Total Allowances</strong></td><td></td><td><strong>$[amount]</strong></td></tr>
</tbody>
</table>
<p>Allowances will be reconciled against actual cost, and the Contract Sum or GMP will be adjusted by Change Order for the difference [including / excluding] markup on the overage.</p>
HTML,
        ],
        [
            'heading' => 'Alternates',
            'tip'     => 'Number and describe alternates exactly as they appear in the bid form or Division 01 "Alternates" section. Price each independently, state whether it is an add or deduct, give any schedule impact, and include an acceptance deadline — subcontractors will not hold alternate pricing forever.',
            'body'    => <<<'HTML'
<table>
<thead>
<tr><th>Alt. No.</th><th>Description</th><th>Add / Deduct</th><th>Amount</th><th>Schedule impact</th></tr>
</thead>
<tbody>
<tr><td>1</td><td>[e.g., Substitute standing-seam metal roof for TPO membrane]</td><td>[Add]</td><td>$[amount]</td><td>[+X days / none]</td></tr>
<tr><td>2</td><td>[e.g., Delete site lighting at north parking lot]</td><td>[Deduct]</td><td>($[amount])</td><td>[None]</td></tr>
<tr><td>3</td><td>[e.g., Provide emergency generator in lieu of battery backup]</td><td>[Add]</td><td>$[amount]</td><td>[+X days — lead time [X] weeks]</td></tr>
<tr><td>4</td><td>[e.g., Porcelain tile in lieu of LVT at corridors]</td><td>[Add]</td><td>$[amount]</td><td>[None]</td></tr>
</tbody>
</table>
<p>Alternates must be accepted within [30] days of contract execution to hold the prices above.</p>
<h4>Voluntary Value Engineering Options (not included)</h4>
<table>
<thead>
<tr><th>VE No.</th><th>Description</th><th>Potential savings</th><th>Design / owner impact</th></tr>
</thead>
<tbody>
<tr><td>VE-1</td><td>[Description]</td><td>($[amount])</td><td>[Requires architect approval; no impact to performance]</td></tr>
<tr><td>VE-2</td><td>[Description]</td><td>($[amount])</td><td>[Impact]</td></tr>
</tbody>
</table>
HTML,
        ],
        [
            'heading' => 'Unit Prices',
            'tip'     => 'Unit prices protect both parties on quantities that cannot be known in advance — rock, unsuitable soil, concrete repair, pile length. Always state the unit, what it includes (overhead, profit, disposal), and whether the same price applies to adds and deducts. Keep them realistic; unbalanced unit prices can get you rejected on public work.',
            'body'    => <<<'HTML'
<table>
<thead>
<tr><th>No.</th><th>Description</th><th>Unit</th><th>Add price</th><th>Deduct price</th></tr>
</thead>
<tbody>
<tr><td>UP-1</td><td>[Mass rock excavation, including disposal off site]</td><td>CY</td><td>$[amount]</td><td>$[amount]</td></tr>
<tr><td>UP-2</td><td>[Undercut and replace unsuitable soils with compacted structural fill]</td><td>CY</td><td>$[amount]</td><td>$[amount]</td></tr>
<tr><td>UP-3</td><td>[Concrete slab repair / patching]</td><td>SF</td><td>$[amount]</td><td>$[amount]</td></tr>
<tr><td>UP-4</td><td>[Additional duplex receptacle, including circuit extension]</td><td>EA</td><td>$[amount]</td><td>$[amount]</td></tr>
<tr><td>UP-5</td><td>[Additional LF of interior partition, full height, painted]</td><td>LF</td><td>$[amount]</td><td>$[amount]</td></tr>
</tbody>
</table>
<p>Unit prices [include / exclude] overhead and profit and are valid for the duration of the project.</p>
HTML,
        ],
        [
            'heading' => 'Clarifications & Exclusions',
            'tip'     => 'This section is where most post-award disputes are won or lost. Write clarifications as clear statements of what you assumed, and exclusions as what is not in the price — then check them against your low subcontractors\' scope letters so nothing falls between trades. Avoid blanket exclusions that contradict the drawings (e.g., "excludes anything not shown"); owners and courts discount them, and they make you look evasive.',
            'body'    => <<<'HTML'
<h4>Clarifications</h4>
<ol>
<li>Work will be performed during normal working hours, [7:00 a.m. to 3:30 p.m.], Monday through Friday. Weekend or after-hours work required by the owner is [excluded / included only for (specific scope)].</li>
<li>Building permit fees are [included / excluded — by owner]. Plan review fees, impact fees, and tap fees are [excluded / included as Allowance A-X].</li>
<li>Testing and inspection required by the building code and specifications (special inspections) are [by owner's testing agency / included]. Retesting due to failed tests will be paid by {{firm_name}}.</li>
<li>Pricing is based on [open-shop / union / prevailing wage] labor rates.</li>
<li>[Material] prices are held through [MM/DD/YYYY]. Increases in [steel, copper, electrical gear, roofing] exceeding [X]% after that date will be addressed per the escalation provision in the Agreement.</li>
<li>Utility service to the site is assumed available at the property line with adequate capacity; utility company charges are [by owner / Allowance A-X].</li>
<li>Soil conditions are assumed as described in the geotechnical report dated [MM/DD/YYYY]; conditions differing from that report will be handled per the concealed conditions clause.</li>
<li>Owner will provide builder's risk insurance [or: included at Line 7].</li>
<li>Payment and performance bonds are [included / excluded; available at $[X] per $1,000 of contract value].</li>
<li>Retainage of [5 / 10]% will [reduce to X% at 50% completion / be released at substantial completion] per the Agreement.</li>
<li>[Add project-specific assumptions, e.g., "Existing roof structure is assumed adequate for new RTU loads without reinforcement."]</li>
</ol>
<h4>Exclusions</h4>
<ul>
<li>Hazardous materials identification, abatement, or disposal [unless shown in the environmental report and included in Division 02]</li>
<li>Owner-furnished furniture, fixtures, and equipment (FF&amp;E), and their installation unless noted</li>
<li>Low-voltage cabling, IT, audiovisual, and security systems [unless included in Divisions 27/28]</li>
<li>Design services and engineering fees [except delegated design specified in the documents, e.g., fire sprinkler, truss design]</li>
<li>Utility company fees, capacity charges, and impact fees [unless included as an allowance]</li>
<li>Rock excavation, dewatering, or unsuitable soil remediation [except as covered by unit prices or allowances]</li>
<li>Moving or storage of owner property</li>
<li>Commissioning agent fees (coordination with the owner's commissioning agent is included)</li>
<li>Costs resulting from owner-caused delay or changes in the documents after the date of this proposal</li>
<li>[Additional project-specific exclusions]</li>
</ul>
HTML,
        ],
        [
            'heading' => 'Schedule & Milestones',
            'tip'     => 'Include a milestone table in the proposal and a summary CPM schedule as an exhibit. State the start assumption (NTP date, permit in hand, GMP executed) and durations in calendar days. Flag long-lead items and required owner decisions with dates — it protects your schedule and shows the owner exactly what they must do to stay on track.',
            'body'    => <<<'HTML'
<p>{{firm_name}} proposes a construction duration of [number] calendar days from Notice to Proceed, based on [receipt of building permit / GMP execution / early release of site package] by [MM/DD/YYYY].</p>
<table>
<thead>
<tr><th>Milestone</th><th>Target date</th><th>Dependency / notes</th></tr>
</thead>
<tbody>
<tr><td>Contract execution / Notice to Proceed</td><td>[MM/DD/YYYY]</td><td>[Permit issued]</td></tr>
<tr><td>Long-lead procurement released</td><td>[MM/DD/YYYY]</td><td>[Submittal approval within X days]</td></tr>
<tr><td>Mobilization and site work start</td><td>[MM/DD/YYYY]</td><td></td></tr>
<tr><td>Foundations complete</td><td>[MM/DD/YYYY]</td><td></td></tr>
<tr><td>Structure topped out</td><td>[MM/DD/YYYY]</td><td></td></tr>
<tr><td>Building dried in</td><td>[MM/DD/YYYY]</td><td>[Weather-sensitive]</td></tr>
<tr><td>Permanent power energized</td><td>[MM/DD/YYYY]</td><td>[Utility company coordination]</td></tr>
<tr><td>Substantial completion / TCO</td><td>[MM/DD/YYYY]</td><td></td></tr>
<tr><td>Final completion and punch list closed</td><td>[MM/DD/YYYY]</td><td>[30–60 days after substantial]</td></tr>
</tbody>
</table>
<h4>Long-Lead Items</h4>
<table>
<thead>
<tr><th>Item</th><th>Current lead time</th><th>Required release date</th></tr>
</thead>
<tbody>
<tr><td>[Switchgear / electrical distribution]</td><td>[X] weeks</td><td>[MM/DD/YYYY]</td></tr>
<tr><td>[Rooftop units / AHUs]</td><td>[X] weeks</td><td>[MM/DD/YYYY]</td></tr>
<tr><td>[Generator]</td><td>[X] weeks</td><td>[MM/DD/YYYY]</td></tr>
<tr><td>[Structural steel / joists]</td><td>[X] weeks</td><td>[MM/DD/YYYY]</td></tr>
<tr><td>[Elevator]</td><td>[X] weeks</td><td>[MM/DD/YYYY]</td></tr>
</tbody>
</table>
<h4>Owner Decisions Required</h4>
<p>[List decisions and dates, e.g., "Finish selections by MM/DD/YYYY," "Acceptance of Alternates by MM/DD/YYYY," "Approval of long-lead submittals within 10 working days."]</p>
HTML,
        ],
        [
            'heading' => 'Site Logistics & Safety',
            'tip'     => 'Owners of occupied or urban sites weigh this heavily. Attach a site logistics plan (fence line, gates, laydown, crane, trailers, parking, delivery route) for each major phase. Name the superintendent and describe daily safety practices concretely; include your current EMR only if it helps you.',
            'body'    => <<<'HTML'
<h4>Site Logistics</h4>
<p>Our site logistics plan (Exhibit [X]) shows the construction fence, gates, laydown area, trailer location, crane placement, contractor parking, and delivery route for each phase. Key features:</p>
<ul>
<li>Construction access via [street / gate], separated from [public / student / patient / tenant] traffic</li>
<li>Deliveries scheduled [outside peak hours / between X and X] with flaggers at the entrance</li>
<li>Contractor parking at [location] — no workforce parking in owner spaces</li>
<li>Dust, noise, and vibration controls: [measures]; noisy work limited to [hours]</li>
<li>Erosion and sediment control per the SWPPP / [state] stormwater permit</li>
<li>[Phasing plan for occupied areas, temporary egress, interim life safety measures, ICRA for healthcare]</li>
</ul>
<h4>Safety</h4>
<p>{{superintendent}} will be on site full-time and is responsible for site safety, supported by [Name, CSP], our Safety Director. Our site-specific safety plan will be submitted before mobilization and includes daily pre-task planning, weekly toolbox talks, weekly inspections, fall protection at [6] feet, silica control, and subcontractor safety orientation for every worker. {{firm_name}}'s current EMR is [0.XX].</p>
HTML,
        ],
        [
            'heading' => 'Subcontractor & Self-Perform Plan',
            'tip'     => 'For a GMP, the owner wants to see a fair, competitive buyout: how many bidders per package, how you level bids, and who approves award. For self-performed work, disclose it and explain how the price was validated (e.g., competitively bid against subs, or checked against historical data) — owners are wary of CMs awarding themselves work.',
            'body'    => <<<'HTML'
<h4>Self-Performed Work</h4>
<p>{{firm_name}} will self-perform [concrete, rough carpentry, door/frame/hardware installation, general labor]. [Our self-perform pricing was competitively bid against (number) subcontractors / validated against historical unit costs], and backup is available for review.</p>
<h4>Major Subcontractors</h4>
<table>
<thead>
<tr><th>Trade package</th><th>Proposed subcontractor</th><th>Bids received</th><th>MWBE / DBE status</th><th>Amount</th></tr>
</thead>
<tbody>
<tr><td>[Earthwork &amp; utilities]</td><td>[Company]</td><td>[X]</td><td>[Certified / N/A]</td><td>$[amount]</td></tr>
<tr><td>[Structural steel]</td><td>[Company]</td><td>[X]</td><td>[Certified / N/A]</td><td>$[amount]</td></tr>
<tr><td>[Roofing]</td><td>[Company]</td><td>[X]</td><td>[Certified / N/A]</td><td>$[amount]</td></tr>
<tr><td>[Mechanical / HVAC]</td><td>[Company]</td><td>[X]</td><td>[Certified / N/A]</td><td>$[amount]</td></tr>
<tr><td>[Plumbing]</td><td>[Company]</td><td>[X]</td><td>[Certified / N/A]</td><td>$[amount]</td></tr>
<tr><td>[Electrical]</td><td>[Company]</td><td>[X]</td><td>[Certified / N/A]</td><td>$[amount]</td></tr>
<tr><td>[Fire protection]</td><td>[Company]</td><td>[X]</td><td>[Certified / N/A]</td><td>$[amount]</td></tr>
</tbody>
</table>
<p>All subcontractors are prequalified for safety (EMR at or below [X.XX]), financial capacity, and bonding [for subcontracts over $[amount]]. Projected MWBE / DBE participation is [X]% ($[amount]) against a goal of [X]%.</p>
HTML,
        ],
        [
            'heading' => 'Bonds & Insurance',
            'tip'     => 'State the bond premium rate and whether it is included. Match insurance limits to the contract requirements (or to the owner\'s draft insurance exhibit); if you cannot meet a requirement, say so here rather than after award. Bond premiums commonly run about 0.5–1.5% of contract value depending on size and your surety relationship — confirm with your broker.',
            'body'    => <<<'HTML'
<h4>Bonds</h4>
<p>100% Performance and 100% Payment Bonds, issued by [surety company, A.M. Best rating], are [included in this proposal at $[amount] / available as an add of $[amount]].</p>
<h4>Insurance</h4>
<table>
<thead>
<tr><th>Coverage</th><th>Limits</th><th>Included</th></tr>
</thead>
<tbody>
<tr><td>Commercial General Liability</td><td>$[1,000,000] per occurrence / $[2,000,000] aggregate</td><td>[Yes]</td></tr>
<tr><td>Automobile Liability</td><td>$[1,000,000] combined single limit</td><td>[Yes]</td></tr>
<tr><td>Umbrella / Excess Liability</td><td>$[amount]</td><td>[Yes]</td></tr>
<tr><td>Workers' Compensation / Employer's Liability</td><td>Statutory / $[1,000,000]</td><td>[Yes]</td></tr>
<tr><td>Builder's Risk</td><td>[Completed value of the Work]</td><td>[Yes / By owner]</td></tr>
<tr><td>Contractor's Pollution Liability</td><td>$[amount]</td><td>[Yes / Not required]</td></tr>
</tbody>
</table>
<p>{{client_name}} and {{architect_name}} will be named as additional insureds [on a primary and non-contributory basis] as required by the contract documents.</p>
HTML,
        ],
        [
            'heading' => 'Warranty & Closeout',
            'tip'     => 'The standard is a one-year correction period from substantial completion (AIA A201 §12.2.2) plus manufacturer warranties that pass through to the owner; state longer specified warranties (roofing, windows, equipment) as they appear in the specs, not as your own promise. Owners value an organized closeout — list what they will receive and when.',
            'body'    => <<<'HTML'
<h4>Warranty</h4>
<p>{{firm_name}} warrants that the Work will conform to the Contract Documents and be free of defects in materials and workmanship for [one (1) year] from the date of Substantial Completion, and will promptly correct non-conforming work reported during that period. Manufacturer and subcontractor warranties specified in the Contract Documents — including [roofing (X-year), window (X-year), mechanical equipment (X-year)] — will be assigned to {{client_name}} at closeout. We will conduct an [11-month] warranty walkthrough with the owner's facilities staff before the correction period expires.</p>
<h4>Closeout Deliverables</h4>
<ul>
<li>Certificate of Substantial Completion (AIA G704) and completed punch list</li>
<li>Certificate of Occupancy [or TCO] and final inspection sign-offs</li>
<li>As-built drawings [and BIM model, if specified]</li>
<li>Operation and maintenance manuals and warranties, organized by specification section [in electronic format]</li>
<li>Attic stock and spare parts as specified</li>
<li>Owner training sessions for [mechanical, electrical, fire alarm, controls] systems, recorded</li>
<li>Commissioning documentation coordinated with the owner's commissioning agent</li>
<li>Final lien waivers from {{firm_name}} and all subcontractors and suppliers; consent of surety to final payment (AIA G707)</li>
<li>Final accounting [GMP] with reconciliation of allowances, contingency, and savings</li>
</ul>
HTML,
        ],
        [
            'heading' => 'Acceptance',
            'tip'     => 'This signature block confirms intent to proceed; the executed AIA or ConsensusDocs agreement will govern. Make sure the proposal amount, validity period, and selected alternates are restated so there is no question what the owner accepted.',
            'body'    => <<<'HTML'
<p>{{client_name}} accepts this proposal from {{firm_name}} for {{project_name}} in the amount of <strong>{{proposal_total}}</strong> [plus accepted Alternates No. (X, X) totaling $[amount], for a revised total of $[amount]], subject to execution of a mutually agreed [AIA / ConsensusDocs / owner] form of agreement incorporating this proposal. This proposal is valid for {{proposal_valid_days}} days from {{submittal_date}}.</p>
<table>
<thead>
<tr><th>Submitted by: {{firm_name}}</th><th>Accepted by: {{client_name}}</th></tr>
</thead>
<tbody>
<tr><td>Signature: ______________________________</td><td>Signature: ______________________________</td></tr>
<tr><td>Name: {{contact_name}}</td><td>Name: [Printed name]</td></tr>
<tr><td>Title: {{contact_title}}</td><td>Title: [Title]</td></tr>
<tr><td>Date: {{submittal_date}}</td><td>Date: [MM/DD/YYYY]</td></tr>
<tr><td>License: {{license_number}}</td><td></td></tr>
</tbody>
</table>
<p>{{firm_name}} · {{firm_address}} · {{firm_phone}} · {{firm_email}} · {{firm_website}}</p>
HTML,
        ],
    ],
];
