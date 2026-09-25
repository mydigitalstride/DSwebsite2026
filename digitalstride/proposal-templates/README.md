# Proposal & RFP/RFQ Templates

Every file in this folder (except this README and files starting with `_`) is one
template. The theme loads them automatically — no registration, no database.

- Library page: `/proposal-templates/` (also embeddable on any page with the
  **Proposal Templates** flexible-content layout)
- Each template: `/proposal-templates/{slug}/` — visitors type their details once,
  every `{{token}}` fills in live, then they **Print / Save as PDF**, **Download
  Word (.doc)**, or **Copy text**.

## Add a new template in 3 steps

1. Copy the closest existing file, e.g. `hvac-residential-proposal.php` →
   `solar-residential-proposal.php`. The file name (minus `.php`) is the URL slug.
2. Change `slug` to match the new file name, then edit `title`, `industry`,
   `summary`, and the `sections`.
3. Save. It appears in the library immediately (after the next page load).

To hide a template without deleting it, rename it to start with `_`
(e.g. `_hvac-residential-proposal.php`).

## File format

```php
<?php
if (!defined('ABSPATH')) exit;

return [
    'slug'     => 'hvac-residential-proposal',   // must equal the file name
    'title'    => 'HVAC Residential Replacement Proposal',
    'industry' => 'hvac',        // see "Industries" below
    'type'     => 'proposal',    // 'rfp' = responding to an RFP / RFQ / bid invite
                                 // 'proposal' = a proposal you send to win the job
    'summary'  => 'One or two sentences shown on the library card.',
    'use_when' => [              // bullets: when to reach for this template
        'Replacing a failed or aging system in an owner-occupied home',
    ],
    'length'   => '4–6 pages',   // typical finished length

    // Live fill-in fields. Every {{key}} used in a section body must be listed.
    // Keys shared across templates (firm_name, contact_name, …) are remembered
    // in the visitor's browser, so they only type them once.
    'fields' => [
        'firm_name'    => 'Your company name',
        'client_name'  => 'Customer name',
        // …
    ],

    'checklist' => [             // "Before you send" checklist
        'Photos of the existing equipment and data plate attached',
    ],

    'sections' => [
        [
            'heading' => 'Cover Letter',
            // On-screen coaching only — never printed or downloaded.
            'tip'     => 'Lead with what the customer told you matters most.',
            // The document text. Allowed HTML: p, h4, ul, ol, li, strong, em,
            // table, thead, tbody, tr, th, td, br.
            'body'    => <<<'HTML'
<p>Dear {{client_name}},</p>
<p>Thank you for inviting {{firm_name}} to [describe the visit]…</p>
HTML,
        ],
    ],
];
```

### Writing conventions

- `{{token}}` — replaced live from the fill-in fields. Declare every token in `fields`.
- `[Square brackets]` — something the writer must fill in by hand. They are
  highlighted on screen so nothing gets missed. Be specific:
  `[Number] years`, `[Project name — City, ST — completion year]`.
- `tip` — the coaching: why the section matters, what evaluators score, typical
  numbers or ranges, common mistakes. Keep it to 1–4 sentences.
- Never invent statistics, certifications, or legal claims in the body. Use a
  bracketed placeholder instead.

### Standard field keys (reuse these so visitors only type them once)

| Key | Label |
|---|---|
| `firm_name` | Your company name |
| `contact_name` | Your name |
| `contact_title` | Your title |
| `firm_phone` | Phone |
| `firm_email` | Email |
| `firm_address` | Office address |
| `firm_website` | Website |
| `license_number` | License number(s) |
| `client_name` | Client / owner name |
| `client_contact` | Client contact person |
| `project_name` | Project name |
| `project_location` | Project address or location |
| `solicitation_number` | RFP / RFQ / bid number |
| `submittal_date` | Submittal date |

### Industries

| `industry` | Audience | Label |
|---|---|---|
| `architecture` | aec | Architecture |
| `engineering` | aec | Engineering |
| `construction` | aec | Construction / GC |
| `hvac` | home_services | HVAC |
| `plumbing` | home_services | Plumbing |
| `electrical` | home_services | Electrical |
| `roofing` | home_services | Roofing |

To add an industry, add it to `ds_pt_industries()` in `inc/proposal-templates.php`.

> These templates are starting points, not legal advice. Have an attorney review
> contract terms, warranties, and payment language before relying on them.
