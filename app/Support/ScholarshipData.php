<?php

namespace App\Support;

/**
 * HARDCODED SAMPLE DATA (prototype lang).
 * Ang mga petsa, requirements, at links dito ay halimbawa — i-verify sa official source
 * bago gamitin sa totoong release. Papalitan ito ng database/model kapag may backend na.
 *
 * levels: 'shs' = Senior High School students, 'college' = College students
 * DIRECT APPLICATION LINKS: application_link is only populated where a direct portal URL was identified.
 * For other listings, keep application_link absent/null until the provider's current portal is verified.
 */
class ScholarshipData
{
    public const TYPES = [
        'government' => 'Government',
        'school' => 'School / University',
        'nonprofit' => 'Non-Profit & Foundation',
        'corporate' => 'Corporate / Company',
        'community' => 'Community-Based',
        'cadetship' => 'Cadetship Programs',
        'international' => 'International',
    ];

    public static function all(): array
    {
        return [
            [
                'id' => 'dost-sei', 'title' => 'DOST-SEI Undergraduate Scholarship', 'provider' => 'Department of Science and Technology – SEI',
                'type' => 'government', 'levels' => ['shs'], 'tags' => 'science technology engineering stem priority courses',
                'summary' => 'Full scholarship for top-performing senior high school graduates who will take up priority science and technology courses.',
                'benefits' => 'Tuition and other school fees, monthly stipend, book allowance, and a one-time allowance for thesis and transportation.',
                'eligibility' => 'Filipino citizen, graduating Grade 12 student, with strong academic standing and enrolling in a DOST-priority S&T course.',
                'opens' => '2026-08-03', 'deadline' => '2026-11-13', 'link' => 'https://sei.dost.gov.ph', 'application_link' => 'https://science-scholarships.ph/',
                'requirements' => ['Accomplished application form', 'PSA birth certificate', 'Report card (Form 138)', 'Certificate of good moral character', 'Proof of family income (ITR or barangay certificate of indigency)', '2×2 ID photos'],
            ],
            [
                'id' => 'ched-cmsp', 'title' => 'CHED Merit Scholarship Program (CMSP)', 'provider' => 'Commission on Higher Education',
                'type' => 'government', 'levels' => ['shs', 'college'], 'tags' => 'merit academic honors ched state universities',
                'summary' => 'Merit-based financial assistance for high-achieving students enrolled in CHED-recognized colleges and universities.',
                'benefits' => 'Tuition and other school fees subsidy plus a yearly allowance for living and learning expenses.',
                'eligibility' => 'Filipino citizen with a high academic record and a family income within the program’s limit.',
                'opens' => '2026-09-01', 'deadline' => '2026-12-15', 'link' => 'https://ched.gov.ph',
                'requirements' => ['Application form', 'Certified true copy of grades', 'PSA birth certificate', 'Certificate of enrollment or admission', 'Proof of family income', 'Certificate of good moral character'],
            ],
            [
                'id' => 'ched-tes', 'title' => 'Tertiary Education Subsidy (TES)', 'provider' => 'CHED – UniFAST',
                'type' => 'government', 'levels' => ['college'], 'tags' => 'financial aid subsidy unifast state university 4ps',
                'summary' => 'Financial subsidy for college students in state universities and colleges, prioritizing students from low-income households.',
                'benefits' => 'Subsidy for tuition and other school fees, plus allowances for books, transportation, and living expenses.',
                'eligibility' => 'Currently enrolled Filipino college student in a participating SUC, LUC, or private HEI.',
                'opens' => '2026-10-01', 'deadline' => '2027-01-31', 'link' => 'https://unifast.gov.ph',
                'requirements' => ['TES application form', 'Certificate of registration', 'Proof of household income or 4Ps/Listahanan status', 'Valid school ID', 'PSA birth certificate'],
            ],
            [
                'id' => 'deped-voucher', 'title' => 'Senior High School Voucher Program', 'provider' => 'Department of Education',
                'type' => 'government', 'levels' => ['shs'], 'tags' => 'grade 11 incoming junior high completers private school esc',
                'summary' => 'Voucher that helps Grade 10 completers pay for senior high school in participating private schools and non-DepEd institutions.',
                'benefits' => 'Tuition subsidy paid directly to the participating school, amount based on school location.',
                'eligibility' => 'Grade 10 completer who will enroll in Grade 11 in a participating school.',
                'opens' => '2027-03-01', 'deadline' => '2027-05-31', 'link' => 'https://deped.gov.ph',
                'requirements' => ['Voucher application form', 'Grade 10 completion certificate', 'Report card (Form 138)', 'PSA birth certificate', 'Proof of enrollment in a participating school'],
            ],
            [
                'id' => 'up-oblation', 'title' => 'UP Oblation Scholarship', 'provider' => 'University of the Philippines',
                'type' => 'school', 'levels' => ['shs'], 'tags' => 'upcat top passers university of the philippines',
                'summary' => 'Automatic full scholarship for the top UPCAT qualifiers who choose to enroll in a UP constituent university.',
                'benefits' => 'Free tuition and other fees, plus a book allowance during the length of the degree program.',
                'eligibility' => 'Among the top-ranked UPCAT passers, with continued good academic standing.',
                'opens' => '2026-08-01', 'deadline' => '2026-10-10', 'link' => 'https://up.edu.ph',
                'requirements' => ['UPCAT result', 'Admission slip', 'Report card (Form 138)', 'Good moral certificate', 'Birth certificate'],
            ],
            [
                'id' => 'dlsu-academic', 'title' => 'DLSU Academic Scholarship', 'provider' => 'De La Salle University',
                'type' => 'school', 'levels' => ['shs'], 'tags' => 'university private admissions merit la salle',
                'summary' => 'University-funded grant for incoming first-year students with outstanding senior high school records.',
                'benefits' => 'Partial to full tuition discount, renewable each term if grades are maintained.',
                'eligibility' => 'Incoming freshman admitted to DLSU with a high general weighted average.',
                'opens' => '2026-10-01', 'deadline' => '2027-01-15', 'link' => 'https://dlsu.edu.ph',
                'requirements' => ['Admission confirmation', 'Report card (Form 138)', 'Certificate of good moral character', 'Recommendation letter', 'Proof of family income'],
            ],
            [
                'id' => 'sm-foundation', 'title' => 'SM Foundation College Scholarship', 'provider' => 'SM Foundation',
                'type' => 'nonprofit', 'levels' => ['shs'], 'tags' => 'sm tuition stem accountancy education poor but deserving',
                'summary' => 'Four-year scholarship for financially challenged but deserving students taking up selected college courses.',
                'benefits' => 'Tuition, allowance, and access to a mentoring and internship program.',
                'eligibility' => 'Graduating senior high school student with a good academic record and demonstrated financial need.',
                'opens' => '2026-11-02', 'deadline' => '2027-01-29', 'link' => 'https://sm-foundation.org', 'application_link' => 'https://scholarship.sm-foundation.org/ApplicationForm?AspxAutoDetectCookieSupport=1',
                'requirements' => ['Application form', 'Report card (Form 138)', 'Proof of family income', 'Essay: “Why I deserve this scholarship”', 'Barangay certificate of residency', '1×1 ID photo'],
            ],
            [
                'id' => 'gbf', 'title' => 'Gokongwei Brothers Foundation Scholarship', 'provider' => 'Gokongwei Brothers Foundation',
                'type' => 'nonprofit', 'levels' => ['shs', 'college'], 'tags' => 'foundation engineering business science grant',
                'summary' => 'Scholarship and leadership program for students with strong academic potential and financial need.',
                'benefits' => 'Tuition support, stipend, and leadership development activities.',
                'eligibility' => 'Filipino student with excellent grades, financial need, and good character.',
                'opens' => '2026-12-01', 'deadline' => '2027-03-15', 'link' => 'https://gokongweibrothersfoundation.org',
                'requirements' => ['Application form', 'Grades for the last two terms or school years', 'Personal statement', 'Proof of family income', 'Letter of recommendation'],
            ],
            [
                'id' => 'aboitiz', 'title' => 'Aboitiz Scholarship Program', 'provider' => 'Aboitiz Foundation',
                'type' => 'corporate', 'levels' => ['college'], 'tags' => 'aboitiz engineering energy power company',
                'summary' => 'Company-supported scholarship for college students in engineering and other courses related to the group’s industries.',
                'benefits' => 'Tuition assistance, monthly allowance, and a chance at internship with partner companies.',
                'eligibility' => 'College student in a partner school with a strong academic record.',
                'opens' => '2026-10-15', 'deadline' => '2026-11-30', 'link' => 'https://aboitiz.com',
                'requirements' => ['Application form', 'Certificate of registration', 'Copy of grades', 'Proof of family income', 'Recommendation letter from a professor'],
            ],
            [
                'id' => 'jollibee', 'title' => 'Jollibee Group Foundation Scholarship', 'provider' => 'Jollibee Group Foundation',
                'type' => 'corporate', 'levels' => ['shs'], 'tags' => 'jollibee hospitality business culinary food service',
                'summary' => 'Support for deserving students pursuing college degrees, with opportunities to grow within the company.',
                'benefits' => 'Tuition assistance and a monthly allowance while maintaining required grades.',
                'eligibility' => 'Graduating senior high school student with good academic standing and financial need.',
                'opens' => '2027-01-05', 'deadline' => '2027-03-05', 'link' => 'https://jollibeegroup.com',
                'requirements' => ['Application form', 'Report card (Form 138)', 'Proof of family income', 'Certificate of good moral character', 'Birth certificate'],
            ],
            [
                'id' => 'lgu-iskolar', 'title' => 'Iskolar ng Lungsod (LGU Scholarship)', 'provider' => 'City / Municipal Scholarship Office',
                'type' => 'community', 'levels' => ['shs', 'college'], 'tags' => 'lgu city municipal local government residents barangay',
                'summary' => 'Scholarship from local government units for residents who are enrolled in SHS or college. Sample listing — the real program varies per city.',
                'benefits' => 'Tuition assistance or a fixed allowance per semester.',
                'eligibility' => 'Bona fide resident of the city or municipality for at least a set number of years.',
                'opens' => '2026-10-20', 'deadline' => '2026-12-10', 'link' => 'https://example.com/lgu-scholarship',
                'requirements' => ['Application form', 'Barangay certificate of residency', 'Certificate of enrollment', 'Copy of grades', 'Valid ID of parent or guardian'],
            ],
            [
                'id' => 'barangay-youth', 'title' => 'Barangay Youth Education Grant', 'provider' => 'Barangay Council / Sangguniang Kabataan',
                'type' => 'community', 'levels' => ['shs'], 'tags' => 'sk sangguniang kabataan barangay youth allowance',
                'summary' => 'Community education grant from the barangay for senior high school students in the area. Sample listing for demonstration.',
                'benefits' => 'Yearly school allowance for uniforms, supplies, and projects.',
                'eligibility' => 'Resident of the barangay and currently enrolled in senior high school.',
                'opens' => '2026-11-10', 'deadline' => '2026-12-05', 'link' => 'https://example.com/barangay-grant',
                'requirements' => ['Application letter', 'Barangay certificate of residency', 'Certificate of enrollment', 'Copy of grades'],
            ],
            [
                'id' => 'pma', 'title' => 'PMA Cadetship Program', 'provider' => 'Philippine Military Academy',
                'type' => 'cadetship', 'levels' => ['shs'], 'tags' => 'cadet military army navy air force baguio soldier',
                'summary' => 'Four-year military academy program that leads to a bachelor’s degree and a commission in the Armed Forces of the Philippines.',
                'benefits' => 'Free tuition, board and lodging, uniforms, and a monthly cadet allowance.',
                'eligibility' => 'Filipino citizen, single, of good moral character, and within the required age, height, and medical standards.',
                'opens' => '2026-10-01', 'deadline' => '2027-02-28', 'link' => 'https://pma.edu.ph',
                'requirements' => ['Application form', 'PSA birth certificate', 'Report card (Form 138)', 'Medical and physical exam results', 'NBI or police clearance', 'Passing score on the entrance exam'],
            ],
            [
                'id' => 'pnpa', 'title' => 'PNPA Cadetship Program', 'provider' => 'Philippine National Police Academy',
                'type' => 'cadetship', 'levels' => ['shs'], 'tags' => 'cadet police pnp law enforcement criminology',
                'summary' => 'Four-year cadetship for future police officers, with a Bachelor of Science in Public Safety upon graduation.',
                'benefits' => 'Free education, board and lodging, uniforms, and a cadet allowance.',
                'eligibility' => 'Filipino citizen, single, with no criminal record, meeting the age, height, and medical requirements.',
                'opens' => '2026-11-15', 'deadline' => '2027-03-31', 'link' => 'https://pnpa.edu.ph',
                'requirements' => ['Application form', 'PSA birth certificate', 'Report card (Form 138)', 'Medical and physical exam results', 'NBI clearance', 'Passing score on the entrance exam'],
            ],
            [
                'id' => 'pmma', 'title' => 'PMMA Cadetship Program', 'provider' => 'Philippine Merchant Marine Academy',
                'type' => 'cadetship', 'levels' => ['shs'], 'tags' => 'cadet maritime seafarer marine engineering navigation ship',
                'summary' => 'Government maritime academy program for future ship officers in marine transportation or marine engineering.',
                'benefits' => 'Free tuition, board and lodging, uniforms, and shipboard training.',
                'eligibility' => 'Filipino citizen, single, in good health, with good grades in science and math.',
                'opens' => '2026-09-15', 'deadline' => '2026-12-20', 'link' => 'https://pmma.edu.ph',
                'requirements' => ['Application form', 'PSA birth certificate', 'Report card (Form 138)', 'Medical exam results', 'NBI clearance', 'Entrance exam result'],
            ],
            [
                'id' => 'mext', 'title' => 'MEXT Undergraduate Scholarship (Japan)', 'provider' => 'Government of Japan',
                'type' => 'international', 'levels' => ['shs'], 'tags' => 'japan mext abroad study overseas embassy',
                'summary' => 'Japanese government scholarship for Filipino students to study a full undergraduate degree in Japan.',
                'benefits' => 'Tuition, monthly allowance, and round-trip airfare, with a year of Japanese-language training first.',
                'eligibility' => 'Filipino citizen who finished 12 years of school and falls within the allowed age range.',
                'opens' => '2027-03-01', 'deadline' => '2027-05-20', 'link' => 'https://studyinjapan.go.jp',
                'requirements' => ['Application form', 'Academic transcript', 'Certificate of graduation', 'Certificate of health', 'Recommendation letter from the principal', 'Passport copy'],
            ],
            [
                'id' => 'kgsp', 'title' => 'Korean Government Scholarship (KGSP Undergraduate)', 'provider' => 'Government of South Korea',
                'type' => 'international', 'levels' => ['shs'], 'tags' => 'korea kgsp abroad study overseas niied',
                'summary' => 'Scholarship to pursue a bachelor’s degree in Korea, starting with one year of Korean-language training.',
                'benefits' => 'Airfare, tuition, monthly allowance, medical insurance, and language training.',
                'eligibility' => 'Filipino citizen with a high school diploma and a strong academic record, within the age limit.',
                'opens' => '2027-02-01', 'deadline' => '2027-03-20', 'link' => 'https://studyinkorea.go.kr',
                'requirements' => ['Application form', 'Personal statement and study plan', 'High school diploma and transcript', 'Two recommendation letters', 'Passport copy', 'Medical exam results'],
            ],
        ];
    }
}
