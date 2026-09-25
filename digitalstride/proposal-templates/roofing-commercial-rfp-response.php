<?php
if (!defined('ABSPATH')) exit;

return [
    'slug'     => 'roofing-commercial-rfp-response',
    'title'    => 'Commercial Roofing RFP / Bid Response',
    'industry' => 'roofing',
    'type'     => 'rfp',
    'summary'  => 'A full response to a commercial roofing RFP or bid invitation — existing roof assessment and moisture survey, replacement vs. recover recommendation, membrane system and tapered insulation, NDL manufacturer warranty, phasing for an occupied building, fall-protection safety, maintenance program, bid form, and compliance matrix.',
    'use_when' => [
        'A property manager, school district, municipality, or facilities director has issued an RFP for low-slope roof replacement or recover',
        'A general contractor has invited you to bid the Division 07 roofing scope on a renovation or addition',
        'The owner wants a manufacturer NDL warranty and a recommendation on tear-off vs. recover backed by core cuts and a moisture survey',
        'The building stays occupied during the work and phasing, safety, and weather protection will be scored',
    ],
    'length'   => '12–20 pages plus attachments',

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
        'roof_area_sf'        => 'Roof area (square feet)',
        'membrane_system'     => 'Proposed membrane system (e.g., 60-mil TPO, fully adhered)',
        'project_manager'     => 'Project manager name',
        'bid_validity_days'   => 'Bid validity (days)',
    ],

    'checklist' => [
        'All addenda acknowledged by number and date on the owner\'s bid form; no substituted forms',
        'Roof areas and square footage reconciled against the roof plan, with each area labeled to match the owner\'s drawings',
        'Core cut locations, findings (layers, insulation type and thickness, deck type), and photos included',
        'Moisture survey method (infrared, nuclear, or capacitance) and wet-area map attached, with wet insulation quantified in square feet',
        'Tear-off vs. recover recommendation is consistent with the building code limit on existing roof layers and with the moisture data',
        'Insulation R-value meets the adopted energy code for re-roofing, and the tapered layout achieves positive drainage (typically 1/4 in. per foot)',
        'Wind uplift design and attachment pattern match the specified FM / UL / ASCE 7 requirements for the building location',
        'Manufacturer pre-approval / authorized applicator status confirmed and NDL warranty term and wind-speed coverage stated',
        'Unit prices for deck replacement, wet insulation replacement, and additional tapered insulation included',
        'Phasing plan addresses occupied-building concerns: rooftop unit shutdowns, odors near air intakes, daily watertight tie-ins, and noise',
        'Fall-protection plan (warning lines, guardrails, PFAS, safety monitor) and hoisting/crane plan included',
        'EMR letter, OSHA 300A summaries, and insurance certificate with required endorsements attached',
        'Bid bond and prevailing-wage acknowledgments included if required',
        'Compliance matrix mirrors the RFP numbering; response is within page limits and file format',
    ],

    'sections' => [
        [
            'heading' => 'Cover Letter / Transmittal',
            'tip'     => 'One page, signed by an officer. Acknowledge every addendum and state your manufacturer-approved applicator status up front — for NDL warranty work, an owner cannot award to a contractor the manufacturer will not warrant. Do not put pricing in the letter unless the RFP permits it.',
            'body'    => <<<'HTML'
<p>{{submittal_date}}</p>
<p>{{client_contact}}<br>{{client_name}}<br>[Client mailing address]</p>
<p><strong>RE: {{project_name}} — Roof Replacement — Solicitation No. {{solicitation_number}}</strong></p>
<p>Dear {{client_contact}},</p>
<p>{{firm_name}} is pleased to submit our proposal for the roofing work at {{project_name}}, {{project_location}}. We have reviewed the RFP, the roof plans and specifications dated [Date], and Addenda Nos. [1 through X], and our response addresses all of them.</p>
<p>Based on our site investigation on [Date], including [Number] core cuts and a [infrared / nuclear / capacitance] moisture survey of approximately {{roof_area_sf}} square feet, we recommend a [complete tear-off / recover] with a {{membrane_system}} system over tapered insulation, backed by a [Number]-year manufacturer No Dollar Limit (NDL) warranty.</p>
<p>{{firm_name}} is a [manufacturer-approved / certified] applicator for [Manufacturer(s)], with [Number] years of commercial roofing experience and [Number] low-slope projects completed in the last [Number] years. We understand the building will remain occupied, and our plan is built around keeping it watertight every night and keeping operations running.</p>
<p>This proposal is valid for {{bid_validity_days}} days. {{project_manager}} will be your single point of contact. Please reach me at {{firm_phone}} or {{firm_email}}.</p>
<p>Respectfully,</p>
<p>{{contact_name}}<br>{{contact_title}}<br>{{firm_name}}<br>{{firm_address}}<br>{{firm_website}}<br>License No. {{license_number}}</p>
HTML,
        ],
        [
            'heading' => 'Company Qualifications',
            'tip'     => 'Evaluators want evidence you have done this system, at this size, on an occupied building. Lead with manufacturer approvals, crew size, and largest comparable job. If you self-perform sheet metal and carpentry (blocking, curbs), say so — it reduces coordination risk.',
            'body'    => <<<'HTML'
<table>
<thead>
<tr><th>Item</th><th>Response</th></tr>
</thead>
<tbody>
<tr><td>Legal name / entity type</td><td>[Legal company name — corporation / LLC — state]</td></tr>
<tr><td>Years in commercial roofing</td><td>[Number]</td></tr>
<tr><td>Roofing contractor license</td><td>{{license_number}} — [Jurisdiction — expiration date]</td></tr>
<tr><td>Manufacturer approvals</td><td>[Manufacturer — approval level — since year] (letters attached)</td></tr>
<tr><td>Systems installed regularly</td><td>[TPO / PVC / EPDM / modified bitumen / built-up / metal]</td></tr>
<tr><td>Field crews</td><td>[Number] crews, [Number] field employees; foremen average [Number] years</td></tr>
<tr><td>Self-performed scopes</td><td>[Roofing, sheet metal fabrication, rooftop carpentry, minor deck repair]</td></tr>
<tr><td>Average annual commercial volume</td><td>$[Amount]</td></tr>
<tr><td>Largest single roofing contract</td><td>$[Amount] — [Project name — SF — year]</td></tr>
<tr><td>Industry memberships</td><td>[NRCA / regional roofing association — only those you hold]</td></tr>
<tr><td>Small / diverse business certifications</td><td>[MBE / WBE / DBE / SBE — agency and number, or "None"]</td></tr>
</tbody>
</table>
<p>We have installed approximately [Number] million square feet of low-slope roofing, including [Number] projects with manufacturer NDL warranties. Our in-house sheet metal shop fabricates coping, edge metal, counterflashing, and scuppers to [ANSI/SPRI ES-1 tested profiles / manufacturer details].</p>
HTML,
        ],
        [
            'heading' => 'Existing Roof Assessment',
            'tip'     => 'This is where you earn trust — owners compare this section against what their consultant found. Show each roof area separately with core cut results and photos, and state facts (layers, deck, insulation, drainage) rather than opinions. If you were not allowed to take cores, say what you assumed.',
            'body'    => <<<'HTML'
<p>We inspected all roof areas on [Date], including [Number] core cuts (patched watertight the same day) and a visual survey of drainage, flashings, penetrations, and rooftop equipment. Photos are in [Attachment X].</p>
<table>
<thead>
<tr><th>Roof area</th><th>Approx. SF</th><th>Existing system &amp; layers</th><th>Insulation (type / thickness)</th><th>Deck type</th><th>Key conditions</th></tr>
</thead>
<tbody>
<tr><td>[Area A]</td><td>[Number]</td><td>[e.g., BUR with gravel over 1 prior roof — 2 layers]</td><td>[e.g., 1.5 in. perlite over 1 in. polyiso]</td><td>[22-ga. steel]</td><td>[Ponding at drains; blistering; open laps]</td></tr>
<tr><td>[Area B]</td><td>[Number]</td><td>[e.g., EPDM ballasted — 1 layer]</td><td>[e.g., 2 in. polyiso]</td><td>[Concrete]</td><td>[Shrinkage at perimeter; failed seams]</td></tr>
<tr><td>[Area C]</td><td>[Number]</td><td>[Description]</td><td>[Description]</td><td>[Wood / gypsum / cementitious wood fiber]</td><td>[Conditions]</td></tr>
<tr><td><strong>Total</strong></td><td><strong>{{roof_area_sf}}</strong></td><td></td><td></td><td></td><td></td></tr>
</tbody>
</table>
<h4>Drainage</h4>
<p>[Describe drains, scuppers, gutters, overflow provisions, and ponding locations — e.g., [Number] interior drains with ponding exceeding 48 hours at [locations]; no secondary (overflow) drainage observed.]</p>
<h4>Flashings, penetrations, and rooftop equipment</h4>
<p>[Describe perimeter edge and coping, wall flashings, curbs and RTU heights, pipe penetrations, pitch pans, skylights, and any equipment that must be raised or temporarily disconnected.]</p>
HTML,
        ],
        [
            'heading' => 'Moisture Survey Results',
            'tip'     => 'Wet insulation is what decides tear-off vs. recover, so quantify it. State the method (infrared is best done on a clear evening after a sunny day; nuclear and capacitance give grid readings) and confirm suspect areas with cores. Attach the wet-area map keyed to the roof plan.',
            'body'    => <<<'HTML'
<p>A [infrared thermography / nuclear moisture gauge / electrical capacitance] survey was performed on [Date] under [weather and roof conditions — e.g., clear, dry roof surface after a sunny day]. Anomalies were marked and verified by [Number] confirmation cores.</p>
<table>
<thead>
<tr><th>Roof area</th><th>Total SF</th><th>Wet SF (confirmed)</th><th>% wet</th><th>Confirmation core result</th></tr>
</thead>
<tbody>
<tr><td>[Area A]</td><td>[Number]</td><td>[Number]</td><td>[percentage]%</td><td>[e.g., Saturated perlite, rusted deck flutes at drain]</td></tr>
<tr><td>[Area B]</td><td>[Number]</td><td>[Number]</td><td>[percentage]%</td><td>[Dry]</td></tr>
<tr><td>[Area C]</td><td>[Number]</td><td>[Number]</td><td>[percentage]%</td><td>[Result]</td></tr>
</tbody>
</table>
<p>The wet-area map is provided in [Attachment X]. Wet insulation will be removed and replaced under any option, because trapped moisture degrades insulation value, corrodes steel decks, and can void manufacturer warranties.</p>
HTML,
        ],
        [
            'heading' => 'Recommendation: Replacement vs. Recover',
            'tip'     => 'Give the owner a clear recommendation and the reasoning. Building codes generally prohibit recovering over two or more existing roofs or over wet or deteriorated roofs, so check the layer count first. If you offer recover as an alternate, show the trade-offs honestly — lower first cost and less disruption versus retained moisture risk and possible deck issues left hidden.',
            'body'    => <<<'HTML'
<table>
<thead>
<tr><th>Factor</th><th>Complete tear-off and replacement</th><th>Recover over existing</th></tr>
</thead>
<tbody>
<tr><td>Code eligibility</td><td>Always permitted</td><td>[Permitted only where one existing roof remains, it is dry and sound, and it is adequately attached — Area(s) [X] qualify / do not qualify]</td></tr>
<tr><td>Wet insulation</td><td>All removed</td><td>Wet areas removed and replaced; remaining roof must be dry</td></tr>
<tr><td>Deck inspection</td><td>Entire deck exposed and inspected</td><td>Deck not visible except at cores and wet-area removals</td></tr>
<tr><td>Energy code (insulation)</td><td>[Full R-value upgrade required by code for re-roofing]</td><td>[Confirm whether code insulation requirements apply to recover in this jurisdiction]</td></tr>
<tr><td>Disruption to occupants</td><td>Higher — noise, debris, more crane time</td><td>Lower</td></tr>
<tr><td>Expected service life</td><td>[Number]+ years with maintenance</td><td>[Number] years (subject to existing conditions)</td></tr>
<tr><td>Warranty available</td><td>[Number]-year NDL</td><td>[Number]-year NDL — [confirm with manufacturer]</td></tr>
<tr><td>Relative cost</td><td>Base bid</td><td>[Alternate — deduct $[Amount]]</td></tr>
</tbody>
</table>
<p><strong>Our recommendation:</strong> [Complete tear-off to the deck for all areas / tear-off for Areas A and C and recover for Area B], because [e.g., Area A already has two roofs and cannot legally be recovered, and the moisture survey found [percentage]% wet insulation that would compromise a recover]. This approach gives {{client_name}} [Number] years of expected service life and the full-term NDL warranty.</p>
HTML,
        ],
        [
            'heading' => 'Proposed Roof System',
            'tip'     => 'Write the assembly from the deck up, layer by layer, with thickness, attachment method, and product. Make sure the wind uplift rating and attachment pattern (field, perimeter, corner zones) match the specified FM approval or ASCE 7 design for the site. If you propose a substitution for the basis of design, label it clearly and price it as an alternate.',
            'body'    => <<<'HTML'
<p>We propose the following assembly for all replaced areas, designed to meet [FM 1-[Number] / UL Class A / ASCE 7-[edition] design pressures] and the [Year] [IECC / IBC] as adopted by [Jurisdiction].</p>
<table>
<thead>
<tr><th>Layer (deck up)</th><th>Product / specification</th><th>Attachment</th></tr>
</thead>
<tbody>
<tr><td>Deck preparation</td><td>[Clean, inspect; replace deteriorated deck per unit price; prime rusted steel]</td><td>—</td></tr>
<tr><td>Vapor retarder (if required)</td><td>[Self-adhered vapor retarder — product]</td><td>[Self-adhered]</td></tr>
<tr><td>Base insulation</td><td>[Polyisocyanurate, [Number] layers × [Number] in., staggered joints]</td><td>[Mechanically fastened / low-rise foam adhesive]</td></tr>
<tr><td>Tapered insulation</td><td>[Tapered polyiso, 1/4 in. per foot slope with crickets and saddles]</td><td>[Low-rise foam adhesive]</td></tr>
<tr><td>Cover board</td><td>[1/2 in. HD polyiso / gypsum cover board]</td><td>[Low-rise foam adhesive]</td></tr>
<tr><td>Membrane</td><td>{{membrane_system}} — [Manufacturer / product]</td><td>[Fully adhered / mechanically attached / induction welded]</td></tr>
<tr><td>Flashings</td><td>[Same membrane, reinforced; minimum 8 in. above finished roof]</td><td>[Adhered and terminated per manufacturer detail]</td></tr>
<tr><td>Edge metal and coping</td><td>[[Number]-ga. prefinished steel / .040 aluminum, ANSI/SPRI ES-1 compliant]</td><td>[Continuous cleat]</td></tr>
<tr><td>Walkway pads</td><td>[Manufacturer walkway pads at RTUs, hatches, and service routes]</td><td>[Heat-welded / adhered]</td></tr>
</tbody>
</table>
<h4>Thermal performance and drainage</h4>
<p>The completed assembly provides an average thermal resistance of R-[Number] (minimum R-[Number] at drains), meeting the [energy code edition] requirement of R-[Number] continuous insulation for roofs [entirely above deck] in Climate Zone [Number]. The tapered layout provides a minimum slope of 1/4 in. per foot to [Number] drains [and new overflow scuppers], eliminating ponding documented in the assessment. The tapered insulation layout drawing is provided in [Attachment X].</p>
<h4>Penetrations and rooftop equipment</h4>
<p>[Describe curb height corrections, RTU disconnect/reconnect coordination with the HVAC contractor, new pipe boots, elimination of pitch pans, and skylight or hatch work.]</p>
HTML,
        ],
        [
            'heading' => 'Bid Form — Base Bid, Alternates, and Unit Prices',
            'tip'     => 'Use the owner\'s form if one exists. Unit prices for deck replacement and wet insulation matter a lot on tear-offs because hidden conditions are common — owners compare them closely, and an unreasonably high unit price can cost you the award even with a low base bid. Include an allowance quantity if the RFP asks for one so bids are comparable.',
            'body'    => <<<'HTML'
<p><strong>Project:</strong> {{project_name}}<br><strong>Solicitation No.:</strong> {{solicitation_number}}<br><strong>Bidder:</strong> {{firm_name}}</p>
<p>Addenda acknowledged: No. [1] dated [Date]; No. [X] dated [Date].</p>
<h4>Base bid</h4>
<table>
<thead>
<tr><th>Description</th><th>Amount (figures)</th><th>Amount (words)</th></tr>
</thead>
<tbody>
<tr><td>Base Bid — complete tear-off and installation of {{membrane_system}} system, approx. {{roof_area_sf}} SF, per specifications and addenda, including [Number]-year NDL warranty</td><td>$[Amount]</td><td>[Amount in words] dollars</td></tr>
</tbody>
</table>
<h4>Alternates</h4>
<table>
<thead>
<tr><th>Alt. No.</th><th>Description</th><th>Add / Deduct</th><th>Amount</th></tr>
</thead>
<tbody>
<tr><td>1</td><td>[Recover in lieu of tear-off at Area [X] (where code-eligible)]</td><td>[Deduct]</td><td>$[Amount]</td></tr>
<tr><td>2</td><td>[Upgrade to [Number]-mil membrane / PVC in lieu of TPO]</td><td>[Add]</td><td>$[Amount]</td></tr>
<tr><td>3</td><td>[Extend NDL warranty from [Number] to [Number] years]</td><td>[Add]</td><td>$[Amount]</td></tr>
<tr><td>4</td><td>[Replace existing skylights with new curb-mounted units]</td><td>[Add]</td><td>$[Amount]</td></tr>
<tr><td>5</td><td>[Five-year roof maintenance program (see Maintenance section)]</td><td>[Add]</td><td>$[Amount]</td></tr>
</tbody>
</table>
<h4>Unit prices</h4>
<table>
<thead>
<tr><th>Item</th><th>Unit</th><th>Unit price (installed)</th></tr>
</thead>
<tbody>
<tr><td>Remove and replace steel deck, [22]-ga., [1.5 in. Type B]</td><td>Square foot</td><td>$[Amount]</td></tr>
<tr><td>Remove and replace wood deck, [Number]-in. plywood / plank</td><td>Square foot</td><td>$[Amount]</td></tr>
<tr><td>Remove and replace wet insulation, per inch of thickness</td><td>Board foot</td><td>$[Amount]</td></tr>
<tr><td>Additional tapered insulation</td><td>Board foot</td><td>$[Amount]</td></tr>
<tr><td>Replace deteriorated wood blocking / nailer</td><td>Linear foot</td><td>$[Amount]</td></tr>
<tr><td>New pipe penetration flashing</td><td>Each</td><td>$[Amount]</td></tr>
<tr><td>Raise curb for rooftop unit (up to [Number] in.)</td><td>Each</td><td>$[Amount]</td></tr>
<tr><td>Additional roof drain with sump and connection to existing leader</td><td>Each</td><td>$[Amount]</td></tr>
<tr><td>Roofer — straight time / overtime</td><td>Hour</td><td>$[Amount] / $[Amount]</td></tr>
</tbody>
</table>
<p>[Allowance for deck replacement: [Number] SF included in the base bid, adjusted by unit price, as required by the RFP.] This bid is valid for {{bid_validity_days}} days.</p>
<p>Authorized signature: ______________________<br>Name / Title: {{contact_name}}, {{contact_title}}<br>Date: ____________</p>
HTML,
        ],
        [
            'heading' => 'Phasing Plan for an Occupied Building',
            'tip'     => 'Facilities evaluators score this heavily because it is where roofing projects go wrong — leaks into occupied spaces, adhesive odors pulled into air intakes, and noise during business. Tie each phase to a roof area and show how you keep the building watertight every night. Coordinate RTU shutdowns in writing with the owner\'s HVAC contractor.',
            'body'    => <<<'HTML'
<p>{{client_name}} will remain fully occupied during the work. Our plan limits disruption and keeps the building watertight at the end of every workday.</p>
<table>
<thead>
<tr><th>Phase</th><th>Roof area(s)</th><th>Approx. SF</th><th>Duration</th><th>Occupant considerations</th></tr>
</thead>
<tbody>
<tr><td>1</td><td>[Area A — above [space / department]]</td><td>[Number]</td><td>[Number] working days</td><td>[Relocate staff from [rooms] during tear-off; RTU-1 and RTU-2 shut down [hours]]</td></tr>
<tr><td>2</td><td>[Area B]</td><td>[Number]</td><td>[Number] working days</td><td>[Work around [scheduled events]; no crane lifts over entrance during [hours]]</td></tr>
<tr><td>3</td><td>[Area C]</td><td>[Number]</td><td>[Number] working days</td><td>[Considerations]</td></tr>
</tbody>
</table>
<ul>
<li><strong>Daily tie-ins:</strong> We remove only what can be made watertight the same day. Temporary night seals are installed at the end of each shift and checked by the foreman before leaving.</li>
<li><strong>Weather monitoring:</strong> The foreman reviews forecasts each morning; no tear-off begins if precipitation is forecast within [Number] hours.</li>
<li><strong>Odor and air quality:</strong> We use [low-VOC adhesives / induction-welded or mechanically attached systems near intakes] and coordinate with facilities to close outside-air dampers on affected units during adhesive application.</li>
<li><strong>Noise:</strong> Tear-off and fastening over [sensitive areas] occur [before [Time] / on weekends], as agreed with {{client_contact}}.</li>
<li><strong>Interior protection:</strong> [Drop cloths / temporary dust protection in spaces below tear-off areas; debris chutes and dumpster positioned away from entrances.]</li>
<li><strong>Staging and hoisting:</strong> Crane lifts scheduled [early morning / weekend], with the lift zone barricaded and a qualified signal person and rigger on site.</li>
<li><strong>Communication:</strong> Written two-week look-ahead and daily summary emails to {{client_contact}}; building notices posted [Number] days before each phase.</li>
</ul>
HTML,
        ],
        [
            'heading' => 'Project Schedule',
            'tip'     => 'Show calendar milestones, not just durations, and account for submittal review, manufacturer pre-installation meeting, material lead times, and weather days. Adhesive and membrane application have temperature limits, so if the work straddles cold months, say how you will handle it.',
            'body'    => <<<'HTML'
<table>
<thead>
<tr><th>Milestone</th><th>Duration</th><th>Target date</th></tr>
</thead>
<tbody>
<tr><td>Notice to proceed</td><td>—</td><td>[Date]</td></tr>
<tr><td>Submittals: product data, shop drawings, tapered layout, wind uplift calc, manufacturer approval letter</td><td>[Number] days</td><td>[Date]</td></tr>
<tr><td>Permit issued</td><td>[Number] days</td><td>[Date]</td></tr>
<tr><td>Material procurement (membrane, insulation, edge metal)</td><td>[Number] weeks</td><td>[Date]</td></tr>
<tr><td>Pre-installation meeting with owner, consultant, and manufacturer representative</td><td>—</td><td>[Date]</td></tr>
<tr><td>Phase 1 — [Area]</td><td>[Number] working days</td><td>[Date range]</td></tr>
<tr><td>Phase 2 — [Area]</td><td>[Number] working days</td><td>[Date range]</td></tr>
<tr><td>Phase 3 — [Area]</td><td>[Number] working days</td><td>[Date range]</td></tr>
<tr><td>Manufacturer final inspection and punch list</td><td>[Number] days</td><td>[Date]</td></tr>
<tr><td>NDL warranty issued and closeout documents delivered</td><td>[Number] days</td><td>[Date]</td></tr>
</tbody>
</table>
<p>The schedule includes [Number] weather days. Membrane and adhesive installation will follow the manufacturer's minimum temperature requirements of [Number]°F [and rising]; if cold-weather work is required, we will use [cold-weather adhesives / mechanically attached methods approved by the manufacturer].</p>
HTML,
        ],
        [
            'heading' => 'Safety Program and Fall Protection',
            'tip'     => 'Falls are the leading cause of death in construction, and roofing is among the highest-risk trades, so a specific fall-protection plan is expected, not optional. Provide three years of EMR (1.0 is average) and OSHA TRIR/DART, and attach the carrier\'s EMR letter. Mention how you protect occupants and the public below — owners care about that as much as your crew.',
            'body'    => <<<'HTML'
<table>
<thead>
<tr><th>Safety metric</th><th>[Year 1]</th><th>[Year 2]</th><th>[Year 3]</th></tr>
</thead>
<tbody>
<tr><td>Experience Modification Rate (EMR)</td><td>[Number]</td><td>[Number]</td><td>[Number]</td></tr>
<tr><td>OSHA recordable incident rate (TRIR)</td><td>[Number]</td><td>[Number]</td><td>[Number]</td></tr>
<tr><td>DART rate</td><td>[Number]</td><td>[Number]</td><td>[Number]</td></tr>
<tr><td>OSHA citations (describe)</td><td>[Number]</td><td>[Number]</td><td>[Number]</td></tr>
</tbody>
</table>
<p>Our safety program is overseen by [Name — Safety Director]. Project-specific elements include:</p>
<ul>
<li><strong>Fall protection</strong> per OSHA 29 CFR 1926 Subpart M: [warning-line system set back from the roof edge / guardrails / personal fall arrest systems anchored to engineered anchors / safety monitor where permitted], with guardrails at all access points and hoisting areas.</li>
<li><strong>Skylights and roof openings</strong> covered or guarded before any work begins in the area.</li>
<li><strong>Competent person</strong> for fall protection on site whenever crews are on the roof — [Name].</li>
<li><strong>Hoisting and crane safety:</strong> qualified operator, rigger, and signal person; lift plan submitted before mobilization; barricaded drop zones.</li>
<li><strong>Fire prevention:</strong> [Torch-free system / hot work permits, fire extinguishers within [Number] ft, and a fire watch of [Number] minutes after torch work].</li>
<li><strong>Public and occupant protection:</strong> barricades and signage at entrances, covered walkways where overhead work occurs, and debris chutes.</li>
<li><strong>Training:</strong> OSHA 10 for all workers, OSHA 30 for foremen; documented fall-protection training; daily pre-task planning and weekly toolbox talks.</li>
<li><strong>Heat illness prevention:</strong> water, rest, shade, and acclimatization plan during hot weather.</li>
</ul>
HTML,
        ],
        [
            'heading' => 'Project Team',
            'tip'     => 'Name the foreman, not just the PM — the foreman is who the facility manager will deal with every day. Include manufacturer training or certifications held by field leadership, and attach half-page resumes.',
            'body'    => <<<'HTML'
<table>
<thead>
<tr><th>Role</th><th>Name</th><th>Certifications / training</th><th>Years experience</th><th>Similar projects</th></tr>
</thead>
<tbody>
<tr><td>Project Executive</td><td>{{contact_name}}</td><td>[Certifications]</td><td>[Number]</td><td>[Project names]</td></tr>
<tr><td>Project Manager</td><td>{{project_manager}}</td><td>[Certifications]</td><td>[Number]</td><td>[Project names]</td></tr>
<tr><td>Superintendent / Foreman</td><td>[Name]</td><td>[Manufacturer training — OSHA 30 — competent person]</td><td>[Number]</td><td>[Project names]</td></tr>
<tr><td>Quality Control / Warranty Coordinator</td><td>[Name]</td><td>[Certifications]</td><td>[Number]</td><td>[Project names]</td></tr>
<tr><td>Safety Director</td><td>[Name]</td><td>[Certifications]</td><td>[Number]</td><td>—</td></tr>
</tbody>
</table>
<p>Crew size will average [Number] roofers per day, with peak manpower of [Number]. Quality control includes daily seam probing, [weekly] test cuts where required by the manufacturer, and a documented daily QC log shared with {{client_contact}}.</p>
HTML,
        ],
        [
            'heading' => 'Manufacturer NDL Warranty and Contractor Warranty',
            'tip'     => 'An NDL (No Dollar Limit) warranty means the manufacturer covers repair of covered leaks without a cap tied to original cost — but terms vary by manufacturer, so state term, wind-speed coverage, and exclusions exactly as the manufacturer will issue them and attach a sample. The manufacturer inspects the finished roof before issuing it. Your own workmanship warranty (commonly two years on commercial work) is separate.',
            'body'    => <<<'HTML'
<table>
<thead>
<tr><th>Warranty</th><th>Issued by</th><th>Term</th><th>Coverage</th></tr>
</thead>
<tbody>
<tr><td>Manufacturer system warranty — No Dollar Limit (NDL)</td><td>[Manufacturer]</td><td>[Number] years</td><td>[Membrane, insulation, and accessories supplied by the manufacturer, plus workmanship of the approved applicator — per manufacturer terms]</td></tr>
<tr><td>Wind speed coverage</td><td>[Manufacturer]</td><td>Same</td><td>[Up to [Number] mph peak gust — confirm]</td></tr>
<tr><td>Contractor workmanship warranty</td><td>{{firm_name}}</td><td>[Number] years</td><td>Leaks resulting from our workmanship, repaired at no cost</td></tr>
<tr><td>Sheet metal finish</td><td>[Coating manufacturer]</td><td>[Number] years</td><td>[Chalk and fade per coating manufacturer]</td></tr>
</tbody>
</table>
<p>The NDL warranty will be issued after the manufacturer's technical representative completes a final inspection and all punch-list items are corrected. A sample warranty is provided in [Attachment X]. Warranty terms typically require that roof penetrations or alterations after completion be made by an approved applicator and that the roof be maintained; our maintenance program below is designed to satisfy those conditions.</p>
HTML,
        ],
        [
            'heading' => 'Roof Maintenance Program',
            'tip'     => 'Offer maintenance as a priced option — it protects the owner\'s warranty and gives you recurring work. Twice-yearly inspections (spring and fall) plus after major storms is the common norm. Keep it separate from the base bid so it does not skew price comparisons.',
            'body'    => <<<'HTML'
<p>{{firm_name}} offers a [Number]-year preventive maintenance program beginning at substantial completion.</p>
<table>
<thead>
<tr><th>Task</th><th>Frequency</th></tr>
</thead>
<tbody>
<tr><td>Full roof inspection with photo report and condition rating by area</td><td>Twice per year (spring and fall)</td></tr>
<tr><td>Clear drains, scuppers, gutters, and downspouts of debris</td><td>Each visit</td></tr>
<tr><td>Inspect and reseal flashings, termination bars, pipe boots, and other penetrations</td><td>Each visit</td></tr>
<tr><td>Inspect edge metal, coping, and counterflashing fasteners</td><td>Each visit</td></tr>
<tr><td>Minor repairs (up to [Number] labor hours per visit included)</td><td>Each visit</td></tr>
<tr><td>Post-storm inspection (wind above [Number] mph or hail)</td><td>On request within [Number] hours</td></tr>
<tr><td>Report of damage by other trades (HVAC, satellite, solar) for warranty records</td><td>Each visit</td></tr>
</tbody>
</table>
<table>
<thead>
<tr><th>Service level</th><th>Commitment</th></tr>
</thead>
<tbody>
<tr><td>Emergency leak response</td><td>On site within [Number] hours, 24/7</td></tr>
<tr><td>Non-emergency repair</td><td>Within [Number] business days</td></tr>
<tr><td>Rates outside program — regular / after-hours</td><td>$[Amount] / $[Amount] per hour</td></tr>
</tbody>
</table>
<p><strong>Annual price:</strong> $[Amount] per year ([or $[Amount] per SF per year]), billed [annually / semi-annually].</p>
HTML,
        ],
        [
            'heading' => 'Licensing, Insurance, and Bonding',
            'tip'     => 'Match limits exactly to the RFP and attach a sample COI with the required endorsements (additional insured, primary and non-contributory, waiver of subrogation). Roofing is a hard class to insure, so owners watch this closely. For public work, acknowledge prevailing wage and certified payroll here.',
            'body'    => <<<'HTML'
<h4>Licensing</h4>
<ul>
<li>Roofing / contractor license: {{license_number}} — [Jurisdiction — expiration]</li>
<li>[Local business license / registration]</li>
<li>Manufacturer approved-applicator letters: [Manufacturer(s)] — [Attachment X]</li>
</ul>
<h4>Insurance</h4>
<table>
<thead>
<tr><th>Coverage</th><th>Required limit</th><th>Our limit</th><th>Carrier</th></tr>
</thead>
<tbody>
<tr><td>Commercial General Liability (occurrence / aggregate)</td><td>$[Amount] / $[Amount]</td><td>$[Amount] / $[Amount]</td><td>[Carrier]</td></tr>
<tr><td>Automobile Liability</td><td>$[Amount]</td><td>$[Amount]</td><td>[Carrier]</td></tr>
<tr><td>Workers' Compensation / Employer's Liability</td><td>Statutory / $[Amount]</td><td>Statutory / $[Amount]</td><td>[Carrier]</td></tr>
<tr><td>Umbrella / Excess</td><td>$[Amount]</td><td>$[Amount]</td><td>[Carrier]</td></tr>
<tr><td>[Pollution liability, if required]</td><td>$[Amount]</td><td>$[Amount]</td><td>[Carrier]</td></tr>
</tbody>
</table>
<h4>Bonding</h4>
<p>Surety: [Surety company]. Single-project capacity $[Amount]; aggregate $[Amount]. [Bid bond of [percentage]% enclosed.] Performance and payment bonds are [included / available at [percentage]% of contract value].</p>
<h4>Prevailing wage</h4>
<p>[If applicable:] We acknowledge this project is subject to [Davis-Bacon / state prevailing wage] requirements and will submit certified payroll [weekly].</p>
HTML,
        ],
        [
            'heading' => 'Relevant Experience and References',
            'tip'     => 'Choose references that match the system, size, and occupancy — a school or hospital recover done over the summer is a strong match for an occupied public building. Call each reference beforehand so they are expecting the evaluator\'s call.',
            'body'    => <<<'HTML'
<table>
<thead>
<tr><th>Project / location</th><th>System &amp; scope</th><th>SF</th><th>Contract value</th><th>Completed</th><th>Warranty</th><th>Reference</th></tr>
</thead>
<tbody>
<tr><td>[Project — City, ST]</td><td>[e.g., Tear-off, 60-mil TPO fully adhered, tapered polyiso, occupied school]</td><td>[Number]</td><td>$[Amount]</td><td>[Month / year]</td><td>[Number]-yr NDL</td><td>[Name — title — phone — email]</td></tr>
<tr><td>[Project — City, ST]</td><td>[e.g., Recover over single-ply with cover board, office building]</td><td>[Number]</td><td>$[Amount]</td><td>[Month / year]</td><td>[Warranty]</td><td>[Name — title — phone — email]</td></tr>
<tr><td>[Project — City, ST]</td><td>[e.g., Mod-bit replacement, hospital, phased over 3 areas]</td><td>[Number]</td><td>$[Amount]</td><td>[Month / year]</td><td>[Warranty]</td><td>[Name — title — phone — email]</td></tr>
<tr><td>[Project — City, ST]</td><td>[e.g., Maintenance program for [Number]-building portfolio]</td><td>[Number]</td><td>$[Amount]/yr</td><td>[Since year]</td><td>—</td><td>[Name — title — phone — email]</td></tr>
</tbody>
</table>
HTML,
        ],
        [
            'heading' => 'Compliance Matrix / Requirements Cross-Reference',
            'tip'     => 'Mirror the RFP\'s exact numbering and wording; many public owners score responsiveness pass/fail before they read anything else. Every required form, certification, and "shall" statement belongs here with a page or attachment reference. List any exceptions openly rather than hiding them in clarifications.',
            'body'    => <<<'HTML'
<table>
<thead>
<tr><th>RFP section</th><th>Requirement</th><th>Complies (Y / N / Exception)</th><th>Response location</th></tr>
</thead>
<tbody>
<tr><td>[1.1]</td><td>[Signed transmittal letter]</td><td>[Y]</td><td>Cover Letter, p. [X]</td></tr>
<tr><td>[2.1]</td><td>[Licensed roofing contractor in [State]]</td><td>[Y]</td><td>Licensing, p. [X]</td></tr>
<tr><td>[2.2]</td><td>[Manufacturer-approved applicator for specified system]</td><td>[Y]</td><td>Attachment [X]</td></tr>
<tr><td>[2.3]</td><td>[Minimum [Number] similar projects in [Number] years]</td><td>[Y]</td><td>Experience, p. [X]</td></tr>
<tr><td>[3.1]</td><td>[Existing roof assessment and core cuts]</td><td>[Y]</td><td>Assessment, p. [X]</td></tr>
<tr><td>[3.2]</td><td>[Moisture survey]</td><td>[Y]</td><td>Moisture Survey, p. [X]</td></tr>
<tr><td>[3.3]</td><td>[Roof system meeting FM / UL / energy code]</td><td>[Y]</td><td>Proposed System, p. [X]</td></tr>
<tr><td>[3.5]</td><td>[Phasing plan for occupied building]</td><td>[Y]</td><td>Phasing Plan, p. [X]</td></tr>
<tr><td>[4.1]</td><td>[Bid form — base bid, alternates, unit prices]</td><td>[Y]</td><td>Bid Form, p. [X]</td></tr>
<tr><td>[4.2]</td><td>[Addenda acknowledgment]</td><td>[Y]</td><td>Bid Form, p. [X]</td></tr>
<tr><td>[5.1]</td><td>[[Number]-year NDL warranty]</td><td>[Y]</td><td>Warranty, p. [X]; Attachment [X]</td></tr>
<tr><td>[5.2]</td><td>[Safety program, EMR, fall-protection plan]</td><td>[Y]</td><td>Safety, p. [X]</td></tr>
<tr><td>[6.1]</td><td>[Insurance certificate]</td><td>[Y]</td><td>Attachment [X]</td></tr>
<tr><td>[6.2]</td><td>[Bid bond]</td><td>[Y / N/A]</td><td>Attachment [X]</td></tr>
<tr><td>[6.3]</td><td>[Prevailing wage acknowledgment]</td><td>[Y / N/A]</td><td>Licensing, Insurance, and Bonding, p. [X]</td></tr>
<tr><td>[7.1]</td><td>[Maintenance program pricing]</td><td>[Y]</td><td>Maintenance, p. [X]</td></tr>
<tr><td>[Form X]</td><td>[Non-collusion affidavit / W-9 / MWBE forms]</td><td>[Y]</td><td>Attachment [X]</td></tr>
</tbody>
</table>
<p><strong>Exceptions taken:</strong> [None / list each with RFP section and reason].</p>
<h4>Clarifications and exclusions</h4>
<ol>
<li>Deck replacement beyond the included allowance of [Number] SF will be performed at the unit price after owner approval.</li>
<li>Disconnect, raising, and reconnection of rooftop mechanical and electrical equipment is [included / by owner's HVAC and electrical contractors].</li>
<li>Abatement of asbestos-containing roofing materials is excluded; [a pre-bid asbestos survey was / was not provided]. If suspect materials are found, we will stop work in that area and notify the owner.</li>
<li>Interior repairs from pre-existing leaks are excluded.</li>
<li>[Project-specific clarification tied to a spec section]</li>
</ol>
<h4>Attachments</h4>
<ol>
<li>Signed bid form and addenda acknowledgments</li>
<li>Core cut log and photos; moisture survey report and wet-area map</li>
<li>Tapered insulation layout and wind uplift calculation</li>
<li>Manufacturer approved-applicator letter and sample NDL warranty</li>
<li>Product data sheets</li>
<li>Certificate of insurance, bid bond, EMR letter, OSHA 300A summaries</li>
<li>Key personnel resumes</li>
<li>[Required owner forms]</li>
</ol>
HTML,
        ],
    ],
];
