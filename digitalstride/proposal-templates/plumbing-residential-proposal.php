<?php
if (!defined('ABSPATH')) exit;

return [
    'slug'     => 'plumbing-residential-proposal',
    'title'    => 'Residential Plumbing Proposal: Water Heater, Repipe & Sewer',
    'industry' => 'plumbing',
    'type'     => 'proposal',
    'summary'  => 'A flexible homeowner proposal for water heater replacement, whole-home repipe, or sewer line repair — with inspection and camera findings, an options table (including trenchless vs. open-trench), what\'s included, restoration, permits, warranty, financing, timeline, and signature block.',
    'use_when' => [
        'Replacing a failed or aging tank or tankless water heater, or converting to a heat pump water heater',
        'Recommending a whole-home or partial repipe for galvanized, polybutylene, or leaking copper piping',
        'Presenting sewer line repair or replacement options after a camera inspection — spot repair, open trench, lining, or pipe bursting',
        'Any residential or light-commercial plumbing job large enough that the customer will compare bids',
    ],
    'length'   => '4–7 pages',

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
        'project_location'    => 'Project address or location',
        'proposal_date'       => 'Proposal date',
        'proposal_valid_days' => 'Days this proposal is valid (e.g., 30)',
    ],

    'checklist' => [
        'Delete the option sections that do not apply (water heater, repipe, or sewer) and renumber anything that references them',
        'Photos of the existing water heater data plate, venting, piping failures, or leaks are attached with captions',
        'Sewer camera video or a link to it is provided, with footage markers and depths for each defect',
        'Sewer line was located and depth measured; property line, city tap, and cleanout locations are noted',
        'Water heater sizing is based on household size and peak demand (first-hour rating or GPM), not just matching the old tank',
        'UEF ratings, venting type, and any gas line, electrical, or condensate requirements are listed for each water heater option',
        'Repipe proposal states pipe material, number of fixtures, and exactly how many wall openings and who patches and paints',
        'Trenchless options were confirmed feasible (pipe diameter, bends, collapse, access) before being offered',
        'Right-of-way or street work, city tap connection, and utility locate (811) requirements are addressed',
        'Permit and inspection costs are included in price, and code upgrades (expansion tank, seismic straps, drain pan, cleanouts, backwater valve) are explained',
        'Landscaping, hardscape, and drywall restoration scope is spelled out — what is included vs. excluded',
        'Warranty terms separate manufacturer coverage from your workmanship warranty',
        'Financing examples disclose that approval is subject to credit and include lender-required language',
        'Rebate placeholders (e.g., heat pump water heater incentives) are marked as estimates and eligibility verified',
        'Proposal expiration, deposit amount, and state-required right-to-cancel notice for in-home sales are included',
        'License number appears on the proposal as your state requires',
    ],

    'sections' => [
        [
            'heading' => 'Cover Letter',
            'tip'     => 'Restate the problem in the homeowner\'s words — "no hot water after two showers," "the basement drain backed up twice this year." Plumbing jobs are often urgent and stressful, so a calm, clear summary of what happens next builds trust. Keep it short.',
            'body'    => <<<'HTML'
<p>{{proposal_date}}</p>
<p>{{client_name}}<br>
{{project_location}}</p>
<p>Dear {{client_name}},</p>
<p>Thank you for calling {{firm_name}} about [describe the problem in the customer's words — e.g., the recurring backup in your basement floor drain / running out of hot water / the pinhole leaks in your copper lines]. During our visit on [date], we [inspected your water heater and venting / performed a video camera inspection of your sewer line / inspected the water supply piping throughout the home].</p>
<p>This proposal explains what we found, the options we recommend with honest pros and cons, and exactly what's included — from permits to clean-up and restoration. [If urgent: "We have made your home safe for now by (describe temporary measure), and we can begin the permanent repair as soon as (date)."]</p>
<p>If you have questions or would like us to walk through the camera footage or photos with you again, please call me directly at {{firm_phone}}.</p>
<p>Sincerely,</p>
<p>{{contact_name}}<br>
{{contact_title}}, {{firm_name}}<br>
{{firm_phone}} | {{firm_email}}<br>
License {{license_number}}</p>
HTML,
        ],
        [
            'heading' => 'What We Found',
            'tip'     => 'Evidence wins plumbing jobs. Include photos and, for sewer work, camera footage with distances and a sketch of the line — homeowners who see the root mass or offset joint rarely need persuading. Separate what is urgent (active leak, gas venting hazard, collapse) from what is advisable, and never overstate a finding.',
            'body'    => <<<'HTML'
<h4>Existing Conditions</h4>
<table>
<thead>
<tr><th>Item</th><th>Observed / Measured</th><th>Why It Matters</th><th>Photo / Video</th></tr>
</thead>
<tbody>
<tr><td>[Water heater]</td><td>[(#)-gallon (gas / electric), manufactured (year) — (#) years old; rust at base; leaking at tank]</td><td>[Tank leaks are not repairable; risk of water damage]</td><td>[#1]</td></tr>
<tr><td>[Venting / combustion]</td><td>[Improper vent slope; backdrafting at draft hood; CO reading (#) ppm]</td><td>[Safety concern — combustion gases may enter the home]</td><td>[#2]</td></tr>
<tr><td>[Water pressure]</td><td>[(#) psi static; no pressure-reducing valve / failed PRV]</td><td>[Pressure above 80 psi stresses pipes and fixtures]</td><td>[#3]</td></tr>
<tr><td>[Supply piping]</td><td>[Galvanized steel / polybutylene / Type M copper with (#) pinhole leaks; low flow at (fixtures)]</td><td>[Corrosion and failure likely to continue]</td><td>[#4]</td></tr>
<tr><td>[Code / safety items]</td><td>[No expansion tank; no drain pan; missing seismic straps; T&amp;P discharge line incorrect]</td><td>[Required by code when the water heater is replaced]</td><td>[#5]</td></tr>
</tbody>
</table>
<h4>Sewer Camera Inspection Findings</h4>
<p>We inspected the building sewer from [cleanout location / roof vent / toilet pull] to [the city main / property line] on [date]. The line is [4]-inch [cast iron / clay / Orangeburg / PVC], approximately [#] feet long, at a depth of [#] to [#] feet.</p>
<table>
<thead>
<tr><th>Distance from Access</th><th>Depth</th><th>Defect</th><th>Severity</th><th>Video Timestamp</th></tr>
</thead>
<tbody>
<tr><td>[18] ft</td><td>[4] ft</td><td>[Root intrusion at joint]</td><td>[Moderate — partial blockage]</td><td>[02:14]</td></tr>
<tr><td>[42] ft</td><td>[5] ft</td><td>[Offset joint, (1)-inch]</td><td>[Major — catches paper/solids]</td><td>[05:30]</td></tr>
<tr><td>[55–63] ft</td><td>[6] ft</td><td>[Belly / sag holding water]</td><td>[Major]</td><td>[06:48]</td></tr>
<tr><td>[70] ft</td><td>[6] ft</td><td>[Cracked / broken pipe]</td><td>[Severe — risk of collapse]</td><td>[08:02]</td></tr>
</tbody>
</table>
<p>[Location sketch: describe or attach a sketch showing the house, cleanout, line path, defects, and connection to the city main, with the portion that is the homeowner's responsibility vs. the city's.]</p>
<h4>Our Recommendation</h4>
<p>[Summarize in plain language, e.g., "Because the water heater is 14 years old and leaking from the tank, replacement is the only option." / "Because the damage is spread along most of the line, a single spot repair would leave the other defects in place — we recommend full replacement." / "Repairing individual leaks will not stop new ones; the pipe is corroding from the inside."]</p>
HTML,
        ],
        [
            'heading' => 'Options: Water Heater Replacement',
            'tip'     => 'Size by household demand — first-hour rating for tanks, GPM at the required temperature rise for tankless — not by what was there before. Explain venting, gas line, and electrical requirements up front, since those drive price differences between bids. Delete this section if the job is not a water heater.',
            'body'    => <<<'HTML'
<p>Based on [#] people in your home, [#] bathrooms, and [large soaking tub / simultaneous showers], your home needs a first-hour rating of about [#] gallons (tank) or [#] GPM at a [#] °F temperature rise (tankless).</p>
<table>
<thead>
<tr><th></th><th>Good</th><th>Better (Recommended)</th><th>Best</th></tr>
</thead>
<tbody>
<tr><td><strong>Type</strong></td><td>[Standard atmospheric-vent gas tank]</td><td>[Power-vent / high-efficiency condensing tank]</td><td>[Condensing tankless / Heat pump water heater]</td></tr>
<tr><td><strong>Brand / model</strong></td><td>[Brand / model]</td><td>[Brand / model]</td><td>[Brand / model]</td></tr>
<tr><td><strong>Capacity</strong></td><td>[50] gal</td><td>[50] gal</td><td>[#] GPM / [65] gal</td></tr>
<tr><td><strong>First-hour rating / flow</strong></td><td>[#] gal</td><td>[#] gal</td><td>[#] GPM / [#] gal</td></tr>
<tr><td><strong>Efficiency (UEF)</strong></td><td>[0.6x]</td><td>[0.8x]</td><td>[0.9x / 3.x]</td></tr>
<tr><td><strong>Venting / power</strong></td><td>[Existing B-vent, relined as needed]</td><td>[PVC vent to sidewall; 120V outlet]</td><td>[PVC concentric vent; gas line upsized to (#)"; condensate drain] / [240V, (#)A circuit; condensate drain]</td></tr>
<tr><td><strong>Estimated annual operating cost</strong></td><td>$[amount]</td><td>$[amount]</td><td>$[amount]</td></tr>
<tr><td><strong>Expected service life</strong></td><td>[8–12] years</td><td>[10–15] years</td><td>[15–20] years</td></tr>
<tr><td><strong>Manufacturer tank / heat exchanger warranty</strong></td><td>[6] years</td><td>[#] years</td><td>[#] years</td></tr>
<tr><td><strong>Manufacturer parts warranty</strong></td><td>[6] years</td><td>[#] years</td><td>[#] years</td></tr>
<tr><td><strong>{{firm_name}} labor warranty</strong></td><td>[1] year</td><td>[#] years</td><td>[#] years</td></tr>
<tr><td><strong>Annual maintenance</strong></td><td>Flush recommended</td><td>Flush recommended</td><td>[Descale annually / clean air filter]</td></tr>
<tr><td><strong>Investment</strong></td><td><strong>$[price]</strong></td><td><strong>$[price]</strong></td><td><strong>$[price]</strong></td></tr>
<tr><td><strong>Estimated rebates</strong></td><td>—</td><td>– $[amount]</td><td>– $[amount]</td></tr>
<tr><td><strong>Monthly payment example</strong></td><td>$[amount]/mo</td><td>$[amount]/mo</td><td>$[amount]/mo</td></tr>
</tbody>
</table>
<p><em>Operating costs are estimates based on [manufacturer / federal EnergyGuide data and current local rates] and will vary. Rebate amounts are estimates — heat pump water heaters may qualify for [utility] rebates and federal tax credits [if in effect for the installation year]; consult your tax professional.</em></p>
<h4>Why We Recommend the Better Option</h4>
<p>[Tie to the customer's needs, e.g., "Your current water heater is in a finished basement next to the bedrooms. The power-vent unit lets us vent through the side wall instead of relining the old chimney, and it recovers faster for your family's back-to-back morning showers."]</p>
HTML,
        ],
        [
            'heading' => 'Options: Whole-Home Repipe',
            'tip'     => 'Homeowners\' biggest worry about repiping is the holes in their walls, so be explicit about the number of openings, how long water is off, and who patches and paints. Compare PEX and copper honestly — both are code-approved; PEX is typically faster and less invasive, copper is preferred by some owners and certain water conditions. Delete this section if not applicable.',
            'body'    => <<<'HTML'
<p>Your home has [#] bathrooms, a kitchen, laundry, [#] hose bibbs, and [water heater / softener / ice maker / other] connections — [#] fixture connections in total. The proposed repipe replaces [all hot and cold water supply piping from the main shutoff to each fixture / the (describe) portion only].</p>
<table>
<thead>
<tr><th></th><th>Option A: PEX-A (Recommended)</th><th>Option B: Type L Copper</th><th>Option C: Partial Repipe</th></tr>
</thead>
<tbody>
<tr><td><strong>Scope</strong></td><td>Whole home, main shutoff to all fixtures</td><td>Whole home, main shutoff to all fixtures</td><td>[Describe section — e.g., main line and kitchen/laundry only]</td></tr>
<tr><td><strong>Material & fittings</strong></td><td>PEX-A with [expansion / crimp] fittings, [home-run manifold / trunk-and-branch]</td><td>Type L copper, soldered [or press] fittings</td><td>[Material]</td></tr>
<tr><td><strong>New shutoff valves at fixtures</strong></td><td>Included — quarter-turn</td><td>Included — quarter-turn</td><td>[Affected fixtures only]</td></tr>
<tr><td><strong>New main shutoff / PRV</strong></td><td>[Included]</td><td>[Included]</td><td>[Included / N/A]</td></tr>
<tr><td><strong>Estimated wall/ceiling openings</strong></td><td>[#], approx. [#] x [#] in. each</td><td>[#], approx. [#] x [#] in. each</td><td>[#]</td></tr>
<tr><td><strong>Water off during work</strong></td><td>[Evenings restored daily / (#) hours on final day]</td><td>[Same]</td><td>[#] hours</td></tr>
<tr><td><strong>Duration</strong></td><td>[2–3] days + drywall patch</td><td>[3–5] days + drywall patch</td><td>[1–2] days</td></tr>
<tr><td><strong>Pros</strong></td><td>Flexible, fewer fittings and openings, resists freeze splitting, quieter</td><td>Long track record; rigid; some owners prefer metal</td><td>Lower cost now</td></tr>
<tr><td><strong>Considerations</strong></td><td>Must be protected from UV exposure</td><td>Higher material cost; [aggressive water can cause pinholes]</td><td>Remaining old pipe may continue to fail</td></tr>
<tr><td><strong>Manufacturer pipe warranty</strong></td><td>[#] years (installed by licensed plumber)</td><td>[Per manufacturer]</td><td>[Per material]</td></tr>
<tr><td><strong>{{firm_name}} workmanship warranty</strong></td><td>[#] years</td><td>[#] years</td><td>[#] year(s)</td></tr>
<tr><td><strong>Drywall patching</strong></td><td>[Included — patched, textured, primed / Paint by owner]</td><td>[Same]</td><td>[Same]</td></tr>
<tr><td><strong>Investment</strong></td><td><strong>$[price]</strong></td><td><strong>$[price]</strong></td><td><strong>$[price]</strong></td></tr>
<tr><td><strong>Monthly payment example</strong></td><td>$[amount]/mo</td><td>$[amount]/mo</td><td>$[amount]/mo</td></tr>
</tbody>
</table>
<p>[Note if applicable: "Your home's electrical system may be grounded to the existing metal water pipe. When metal piping is replaced with PEX, the electrical grounding/bonding must be verified and, if needed, corrected by a licensed electrician — (included / priced separately at $(amount))."]</p>
HTML,
        ],
        [
            'heading' => 'Options: Sewer Line Repair or Replacement',
            'tip'     => 'Offer trenchless options only after confirming the line can accept them — pipe diameter, bends, severity of offsets or collapse, and access pits all matter. Explain why a belly usually can\'t be fixed by lining, and clarify which portion of the line is the homeowner\'s responsibility vs. the city\'s. Delete this section if not applicable.',
            'body'    => <<<'HTML'
<p>The options below address the defects identified in the camera inspection. Lengths and depths are based on our locate; final pricing may change only as described in the Terms Summary.</p>
<table>
<thead>
<tr><th></th><th>Option 1: Spot Repair</th><th>Option 2: Open-Trench Replacement</th><th>Option 3: Trenchless Pipe Lining (CIPP)</th><th>Option 4: Trenchless Pipe Bursting</th></tr>
</thead>
<tbody>
<tr><td><strong>What it is</strong></td><td>Excavate and replace a short section at the worst defect</td><td>Excavate the full length and install new pipe</td><td>Resin-saturated liner cured inside the existing pipe, creating a new pipe within the old</td><td>New HDPE pipe pulled through, fracturing the old pipe outward</td></tr>
<tr><td><strong>Length addressed</strong></td><td>[#] ft at [location]</td><td>[#] ft, cleanout to [city main / property line]</td><td>[#] ft</td><td>[#] ft</td></tr>
<tr><td><strong>New pipe material</strong></td><td>[SDR-35 / Schedule 40 PVC]</td><td>[SDR-35 / Schedule 40 PVC]</td><td>[Epoxy / resin liner, (#) mm wall]</td><td>[HDPE, (#)-inch]</td></tr>
<tr><td><strong>Excavation</strong></td><td>[1] pit, approx. [#] x [#] ft</td><td>Full trench, approx. [#] ft long x [#] ft deep</td><td>[0–2] access points [through cleanouts]</td><td>[2] pits (launch and receiving)</td></tr>
<tr><td><strong>Fixes roots / cracks / offsets</strong></td><td>At repair location only</td><td>Yes — full length</td><td>Yes [minor offsets only]</td><td>Yes</td></tr>
<tr><td><strong>Fixes bellies / sags</strong></td><td>At repair location only</td><td>Yes — regraded to proper slope</td><td>No — liner follows existing grade</td><td>Generally no</td></tr>
<tr><td><strong>Impact on yard / driveway / landscape</strong></td><td>Small area</td><td>Largest — [lawn, (#) ft of driveway / walkway]</td><td>Minimal</td><td>Limited to pits</td></tr>
<tr><td><strong>New cleanout(s)</strong></td><td>[Included]</td><td>[Two-way cleanout at house and property line]</td><td>[Included]</td><td>[Included]</td></tr>
<tr><td><strong>Duration</strong></td><td>[1] day</td><td>[2–4] days</td><td>[1] day</td><td>[1–2] days</td></tr>
<tr><td><strong>Pros</strong></td><td>Lowest cost now</td><td>Corrects all defects including grade; visible inspection</td><td>Little digging; fast; preserves landscaping and hardscape</td><td>Can upsize pipe; little digging</td></tr>
<tr><td><strong>Considerations</strong></td><td>Other defects remain; future repairs likely</td><td>Most disruption; restoration required</td><td>Slightly reduces diameter; not suitable for collapsed sections or bellies</td><td>Requires suitable soil and clearance from other utilities</td></tr>
<tr><td><strong>{{firm_name}} warranty</strong></td><td>[#] year(s) on repaired section</td><td>[#] years</td><td>[#] years</td><td>[#] years</td></tr>
<tr><td><strong>Investment</strong></td><td><strong>$[price]</strong></td><td><strong>$[price]</strong></td><td><strong>$[price]</strong></td><td><strong>$[price]</strong></td></tr>
<tr><td><strong>Monthly payment example</strong></td><td>$[amount]/mo</td><td>$[amount]/mo</td><td>$[amount]/mo</td><td>$[amount]/mo</td></tr>
</tbody>
</table>
<h4>Our Recommendation</h4>
<p>[e.g., "We recommend Option 2 because the belly between 55 and 63 feet holds standing water, and lining would follow the same sag. If preserving your driveway is the priority, a hybrid approach — open-trench through the belly and lining for the remaining section — is available at $(amount)."]</p>
<h4>City / Right-of-Way Work</h4>
<p>[If the defect extends beyond the property line: "The portion from the property line to the city main is [your responsibility / the city's responsibility] under [City] rules. Work in the street or sidewalk requires a right-of-way permit, traffic control, and street restoration to city standards — (included / priced separately at $(amount))."]</p>
HTML,
        ],
        [
            'heading' => 'What\'s Included',
            'tip'     => 'Itemize everything — permits, haul-away, code-required upgrades, and clean-up — because low bids often leave these out. A clear exclusions list prevents install-day disputes. Keep only the bullets that apply to the selected job.',
            'body'    => <<<'HTML'
<h4>All Projects</h4>
<ul>
<li>Licensed plumber on site for the duration of the work</li>
<li>All permits, inspection fees, and scheduling of inspections</li>
<li>Utility locate request (811) before any excavation</li>
<li>Floor and furnishing protection; daily clean-up</li>
<li>Removal and disposal or recycling of old materials</li>
<li>Final walk-through, and operation and warranty documents</li>
</ul>
<h4>Water Heater Projects</h4>
<ul>
<li>Drain and remove existing water heater</li>
<li>New water heater, [drain pan with drain line], and [seismic straps where required]</li>
<li>Thermal expansion tank, sized and pre-charged to your water pressure</li>
<li>New gas flex connector, shutoff valve, and sediment trap; leak test</li>
<li>New [venting / vent connector], checked for proper draft</li>
<li>New T&amp;P relief valve discharge line to an approved location</li>
<li>New water connectors and shutoff valve; [dielectric unions / mixing valve where required]</li>
<li>[Condensate drain / neutralizer for condensing units]</li>
</ul>
<h4>Repipe Projects</h4>
<ul>
<li>New supply piping, fittings, hangers, and insulation where exposed to unconditioned space</li>
<li>New quarter-turn shutoff valves and supply lines at each fixture</li>
<li>Pressure test of the new system before walls are closed</li>
<li>Abandonment of old piping in place where removal would require additional openings</li>
</ul>
<h4>Sewer Projects</h4>
<ul>
<li>Pre- and post-work camera inspection, with video of the finished line provided to you</li>
<li>Excavation, shoring as required, bedding, and compacted backfill</li>
<li>New cleanout(s) as specified in your selected option</li>
<li>[Backwater valve if required by code or requested]</li>
</ul>
<h4>Not Included (Unless Listed in Your Option)</h4>
<ul>
<li>Painting, wallpaper, tile, or specialty finish replacement</li>
<li>Electrical work beyond [the water heater circuit connection]</li>
<li>Replacement of fixtures, faucets, or appliances</li>
<li>Removal of rock, concrete, or obstructions not visible during our inspection</li>
<li>Asbestos or lead testing and abatement</li>
<li>Landscaping, irrigation, or hardscape beyond the restoration described below</li>
</ul>
HTML,
        ],
        [
            'heading' => 'Permits, Code & Inspections',
            'tip'     => 'Explain code-required items as safety and compliance, not upsells — homeowners are more receptive when they understand the inspector will require them. Name the adopted code (IPC or UPC) and the jurisdiction. Unpermitted work can cause problems at resale and with insurance claims, which is worth mentioning.',
            'body'    => <<<'HTML'
<p>All work will be performed to the [International Plumbing Code / Uniform Plumbing Code] [and Fuel Gas Code] as adopted by [City / County], including local amendments. {{firm_name}} will obtain the required permit(s) and schedule and attend all inspections.</p>
<table>
<thead>
<tr><th>Permit / Inspection</th><th>Issuing Authority</th><th>Included</th></tr>
</thead>
<tbody>
<tr><td>[Plumbing permit — water heater / repipe / sewer]</td><td>[Jurisdiction]</td><td>Yes</td></tr>
<tr><td>[Gas / mechanical permit]</td><td>[Jurisdiction]</td><td>[Yes / N/A]</td></tr>
<tr><td>[Right-of-way / street opening permit]</td><td>[City public works]</td><td>[Yes / Priced separately / N/A]</td></tr>
<tr><td>[Sewer connection inspection]</td><td>[Sewer authority]</td><td>[Yes / N/A]</td></tr>
</tbody>
</table>
<h4>Code-Required Upgrades Included in This Proposal</h4>
<ul>
<li>[Thermal expansion tank — required on closed systems with a check valve or PRV]</li>
<li>[Seismic strapping — required in (jurisdiction)]</li>
<li>[Drain pan — required when installed where leakage could cause damage]</li>
<li>[Cleanout at the building / property line]</li>
<li>[Pressure-reducing valve — static pressure exceeds 80 psi]</li>
<li>[Combustion air / venting corrections]</li>
</ul>
HTML,
        ],
        [
            'heading' => 'Site Protection & Restoration',
            'tip'     => 'Restoration is where plumbing customers are most often disappointed, so define it precisely: backfill and compaction, topsoil and seed vs. sod, concrete replacement, drywall patching level. If you subcontract drywall or concrete, say so. Settlement of trench backfill is normal — set expectations and say whether you return to top it off.',
            'body'    => <<<'HTML'
<h4>Inside Your Home</h4>
<ul>
<li>Drop cloths and floor runners from the entrance to the work area</li>
<li>Plastic sheeting and dust control around wall openings</li>
<li>Wall and ceiling openings [patched, taped, textured to match as closely as practical, and primed, ready for your paint / patched to a smooth finish; texture and paint by owner]</li>
<li>Drywall work performed by [our crew / (subcontractor name)] approximately [#] days after plumbing inspection</li>
</ul>
<h4>Outside Your Home (Sewer / Excavation)</h4>
<ul>
<li>Sod and topsoil set aside on tarps and replaced where practical</li>
<li>Backfill compacted in lifts; [topsoil and grass seed / new sod] over trench area</li>
<li>[#] sq ft of [concrete driveway / walkway] saw-cut, removed, and replaced to match thickness; color and finish may vary from existing</li>
<li>Irrigation lines damaged during excavation [repaired / excluded]</li>
<li>Shrubs and plants in the trench path [carefully removed and replanted / relocated by owner before work]</li>
<li>We return at [30–60] days to top off any trench settlement at no charge</li>
</ul>
HTML,
        ],
        [
            'heading' => 'Warranty',
            'tip'     => 'Separate the manufacturer\'s warranty (parts) from your workmanship warranty (labor), and state registration requirements. For sewer work, be clear that the warranty covers your work, not the city\'s portion of the line or new root intrusion at unrepaired sections. Only promise what you can honor.',
            'body'    => <<<'HTML'
<h4>Manufacturer Warranty</h4>
<p>Water heaters, PEX, liners, and other materials carry the manufacturer's limited warranty as listed in your selected option. Some warranties require product registration within [#] days — {{firm_name}} will register your equipment and send you confirmation.</p>
<h4>{{firm_name}} Workmanship Warranty</h4>
<p>We warrant our installation workmanship for the period listed in your selected option. If a leak or failure results from our work, we will repair it at no charge for labor and will [repair resulting damage to finishes caused by a failure of our workmanship, up to (amount) / describe coverage].</p>
<h4>What Is Not Covered</h4>
<ul>
<li>Existing piping, fixtures, or sections of sewer line not replaced by {{firm_name}}</li>
<li>Damage from freezing, misuse, foreign objects flushed into drains, or grease disposal</li>
<li>Scale buildup or failures caused by water quality where treatment was recommended and declined</li>
<li>Lack of recommended maintenance (e.g., annual water heater flush or tankless descaling)</li>
<li>Normal settling of soil or landscaping after the settlement top-off visit</li>
</ul>
HTML,
        ],
        [
            'heading' => 'Financing & Payment',
            'tip'     => 'Sewer and repipe jobs are often unexpected expenses, so a monthly payment option can be the deciding factor. Always note that payments are examples, approval is subject to credit, and include your lender\'s required disclosure language. Mention if the homeowner\'s insurance or a home warranty might cover part of the loss — without promising coverage.',
            'body'    => <<<'HTML'
<p>We offer financing through [lender name] for projects over $[amount].</p>
<table>
<thead>
<tr><th>Plan</th><th>Term</th><th>APR</th><th>Example on $[project amount]</th></tr>
</thead>
<tbody>
<tr><td>[Promotional same-as-cash]</td><td>[#] months</td><td>[0% if paid in full within term]</td><td>$[amount]/mo</td></tr>
<tr><td>[Fixed-rate installment]</td><td>[#] months</td><td>[#]%</td><td>$[amount]/mo</td></tr>
<tr><td>[Extended low payment]</td><td>[#] months</td><td>[#]%</td><td>$[amount]/mo</td></tr>
</tbody>
</table>
<p><em>Examples for illustration only. Financing provided by [lender], subject to credit approval. [Insert lender-required disclosure.]</em></p>
<p><strong>Insurance and home warranty:</strong> Some homeowner's insurance policies, service line coverage plans, or home warranties may cover part of the cost, particularly resulting water damage. We are happy to provide photos, camera video, and a written description of the cause for your claim. Coverage decisions are made by your insurer or warranty company.</p>
<p><strong>Payment methods:</strong> [Check, ACH, major credit cards]. [Cash / check discount of (#)% if offered.]</p>
HTML,
        ],
        [
            'heading' => 'Project Timeline & What to Expect',
            'tip'     => 'Tell the homeowner how long they will be without water, hot water, or use of drains, and what they need to do to prepare. Emergency jobs should show the fastest realistic start date; larger jobs depend on permit and locate timing, which you should state. Offer workarounds like temporary water or restoring water overnight.',
            'body'    => <<<'HTML'
<table>
<thead>
<tr><th>Step</th><th>Timing</th><th>What Happens</th></tr>
</thead>
<tbody>
<tr><td>1. Acceptance & deposit</td><td>Day 0</td><td>You sign below; we order materials and apply for permits</td></tr>
<tr><td>2. Permit & utility locate</td><td>[#]–[#] business days</td><td>Permit issued; 811 locate marks placed [(2–3) business days required]</td></tr>
<tr><td>3. Work begins</td><td>[Date / within (#) days]</td><td>Crew of [#] arrives at [8:00 a.m.]; site protection set up</td></tr>
<tr><td>4. Main work</td><td>[#] days</td><td>[Water heater installed / piping replaced / sewer line repaired]; [water / drains] unavailable for approx. [#] hours [per day]</td></tr>
<tr><td>5. Inspection</td><td>[Same day / within (#) days]</td><td>Inspector reviews work [before walls are closed / before trench is backfilled]</td></tr>
<tr><td>6. Restoration</td><td>[#] days after inspection</td><td>Drywall patching or backfill, concrete, and landscape restoration</td></tr>
<tr><td>7. Walk-through & final camera video</td><td>Completion</td><td>We review the work, operation, and warranty with you</td></tr>
<tr><td>8. Settlement check</td><td>[30–60] days</td><td>Return visit to top off trench settlement (sewer projects)</td></tr>
</tbody>
</table>
<h4>How to Prepare</h4>
<ul>
<li>Clear access to the water heater, main shutoff, cleanouts, and work areas; move vehicles from the driveway if excavation is planned</li>
<li>Remove valuables and fragile items from walls and shelves near repipe openings</li>
<li>Mark private utilities not covered by 811 — irrigation, invisible dog fence, landscape lighting, septic, or private gas lines</li>
<li>Plan for limited water or drain use during the hours noted; keep pets secured</li>
</ul>
HTML,
        ],
        [
            'heading' => 'Terms Summary',
            'tip'     => 'Underground and in-wall work always carries some unknowns — address them with a clear, fair hidden-conditions clause and unit prices for common extras (additional footage, rock, extra openings). This prevents disputes far better than padding the price. Include any right-to-cancel notice your state requires for in-home sales.',
            'body'    => <<<'HTML'
<ul>
<li><strong>Proposal valid for:</strong> {{proposal_valid_days}} days from {{proposal_date}}.</li>
<li><strong>Deposit:</strong> [#]% ($[amount]) at acceptance; [progress payment of (#)% at (milestone)]; balance due upon completion and walk-through.</li>
<li><strong>Hidden conditions:</strong> If we encounter conditions that could not reasonably be seen during our inspection — such as rock, buried concrete, additional pipe defects, or unforeseen framing obstructions — we will stop, explain the issue, and provide a written change order before proceeding.</li>
<li><strong>Unit prices for common extras:</strong> Additional sewer pipe beyond quoted length $[amount] per ft; additional excavation depth $[amount] per ft; additional wall opening and patch $[amount] each; rock removal $[amount] per [hour / cubic yard].</li>
<li><strong>Changes:</strong> Changes to the scope will be documented in a written change order signed by you before the work is performed.</li>
<li><strong>Licensing & insurance:</strong> {{firm_name}} is licensed ({{license_number}}) and insured; certificates available on request.</li>
<li><strong>Right to cancel:</strong> [Insert state-required cancellation notice, if applicable.]</li>
<li><strong>Full terms:</strong> The complete terms and conditions [attached / on the reverse] are part of this agreement.</li>
</ul>
HTML,
        ],
        [
            'heading' => 'Acceptance',
            'tip'     => 'List only the options you actually presented, with a checkbox for each and any add-ons. Confirm the selected option and total with the homeowner before they sign, and leave a signed copy with them.',
            'body'    => <<<'HTML'
<p>By signing below, I authorize {{firm_name}} to perform the work described in this proposal for the option(s) selected, at {{project_location}}, under the terms stated.</p>
<table>
<thead>
<tr><th>Select</th><th>Option</th><th>Price</th></tr>
</thead>
<tbody>
<tr><td>☐</td><td>[Option name — e.g., Better: power-vent 50-gallon water heater]</td><td>$[price]</td></tr>
<tr><td>☐</td><td>[Option name — e.g., Option A: whole-home PEX repipe]</td><td>$[price]</td></tr>
<tr><td>☐</td><td>[Option name — e.g., Option 3: trenchless lining, (#) ft]</td><td>$[price]</td></tr>
<tr><td>☐</td><td>Add-on: [e.g., whole-home water softener / PRV / backwater valve]</td><td>$[price]</td></tr>
<tr><td>☐</td><td>Add-on: [e.g., drywall paint to match / sod instead of seed]</td><td>$[price]</td></tr>
<tr><td></td><td><strong>Total</strong></td><td><strong>$__________</strong></td></tr>
<tr><td></td><td>Deposit due at signing</td><td>$__________</td></tr>
</tbody>
</table>
<p>Payment method: ☐ Financing ([lender]) ☐ Check ☐ Card ☐ ACH</p>
<p><strong>Customer</strong><br>
Name: {{client_name}}<br>
Signature: ______________________________ Date: ______________</p>
<p><strong>{{firm_name}}</strong><br>
{{contact_name}}, {{contact_title}}<br>
Signature: ______________________________ Date: ______________</p>
<p>{{firm_name}} | {{firm_address}} | {{firm_phone}} | {{firm_website}} | License {{license_number}}</p>
HTML,
        ],
    ],
];
