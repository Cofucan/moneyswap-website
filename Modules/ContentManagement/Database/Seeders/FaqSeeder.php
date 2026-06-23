<?php

namespace Modules\ContentManagement\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class FaqSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if (!DB::getSchemaBuilder()->hasTable('faq_categories') || !DB::getSchemaBuilder()->hasTable('faqs')) {
            return;
        }

        $now = now();

        $categories = [
            ['label' => 'General', 'overview' => 'Fast answers that help you move confidently to your next transaction.', 'icon' => 'bi-info-circle'],
            ['label' => 'Getting Started', 'overview' => 'Action-first onboarding to help you begin your first swap quickly.', 'icon' => 'bi-rocket-takeoff'],
            ['label' => 'Account & Verification', 'overview' => 'Everything you need to unlock your account and higher confidence limits.', 'icon' => 'bi-person-badge'],
            ['label' => 'Swaps & Requests', 'overview' => 'Clear execution guidance so you can post, match, and complete faster.', 'icon' => 'bi-arrow-left-right'],
            ['label' => 'Fees & Pricing', 'overview' => 'Transparent pricing answers to help you decide and confirm with clarity.', 'icon' => 'bi-receipt'],
            ['label' => 'Security & Safety', 'overview' => 'Practical safety moves to protect your account and every transaction.', 'icon' => 'bi-shield-check'],
            ['label' => 'Payouts & Limits', 'overview' => 'Get paid with confidence by understanding timelines and limit paths.', 'icon' => 'bi-cash-stack'],
            ['label' => 'Disputes & Support', 'overview' => 'Resolve issues faster with clear support and escalation guidance.', 'icon' => 'bi-life-preserver'],
        ];

        $categoryIds = [];
        foreach ($categories as $category) {
            $slug = Str::slug($category['label']);
            $existing = DB::table('faq_categories')->where('label', $category['label'])->first();

            if ($existing) {
                DB::table('faq_categories')->where('id', $existing->id)->update([
                    'overview' => $category['overview'],
                    'icon' => $category['icon'],
                    'slug' => !empty($existing->slug) ? $existing->slug : $slug,
                    'published' => 1,
                    'updated_at' => $now,
                ]);
                $categoryIds[$category['label']] = (int) $existing->id;
                continue;
            }

            $categoryIds[$category['label']] = (int) DB::table('faq_categories')->insertGetId([
                'label' => $category['label'],
                'overview' => $category['overview'],
                'slug' => $slug,
                'icon' => $category['icon'],
                'published' => 1,
                'created_at' => $now,
                'updated_at' => $now,
            ]);
        }

        $generalId = $categoryIds['General'] ?? (int) DB::table('faq_categories')->orderBy('id')->value('id');

        if ($generalId) {
            DB::table('faqs')->whereNull('faq_category_id')->update([
                'faq_category_id' => $generalId,
                'updated_at' => $now,
            ]);
        }

        $existingFaqs = DB::table('faqs')->select('id', 'question')->get();
        foreach ($existingFaqs as $faq) {
            if (empty($faq->question)) {
                continue;
            }

            DB::table('faqs')->where('id', $faq->id)->update([
                'slug' => substr(Str::slug($faq->question), 0, 150),
                'updated_at' => $now,
            ]);
        }

        $faqs = [
            ['category' => 'General', 'question' => 'Is MoneySwap regulated?', 'answer' => 'MoneySwap operates with compliance-first controls and partners aligned to applicable legal and financial standards in supported regions.'],
            ['category' => 'General', 'question' => 'Are international transfers treated as local?', 'answer' => 'Not always. Treatment depends on corridor, payout channel, and regulatory requirements for the destination country.'],
            ['category' => 'General', 'question' => 'Are there fees?', 'answer' => 'Yes. MoneySwap displays applicable fees before confirmation so you can decide with full cost visibility.'],
            ['category' => 'General', 'question' => 'Who can use MoneySwap?', 'answer' => 'Individuals and eligible users who complete required onboarding and verification can use MoneySwap features available in their region.'],
            ['category' => 'General', 'question' => 'Is MoneySwap available every day?', 'answer' => 'Platform access is continuous, but completion time can vary based on verification status, counterparty response, and settlement windows.'],

            ['category' => 'Getting Started', 'question' => 'What is MoneySwap?', 'answer' => 'MoneySwap is a currency exchange platform that connects requests with matching offers through a guided, transparent workflow.'],
            ['category' => 'Getting Started', 'question' => 'How do I get started on MoneySwap?', 'answer' => 'Create your account, complete verification, choose a swap flow, and confirm your transaction details before execution.'],
            ['category' => 'Getting Started', 'question' => 'Do I need to register before creating a swap request?', 'answer' => 'Yes. Registration is required so your requests, transactions, and support history remain securely linked to your account.'],
            ['category' => 'Getting Started', 'question' => 'Can I use MoneySwap from my phone?', 'answer' => 'Yes. You can access core account and transaction workflows from mobile-friendly pages and supported mobile experiences.'],
            ['category' => 'Getting Started', 'question' => 'How do I choose the right swap path?', 'answer' => 'Use the How It Works flow to select your track, compare rates, and follow the step-by-step path that matches your goal.'],
            ['category' => 'Getting Started', 'question' => 'Can I explore rates before committing?', 'answer' => 'Yes. You can review available rates and transaction context before confirming any swap.'],

            ['category' => 'Account & Verification', 'question' => 'Why do I need identity verification on MoneySwap?', 'answer' => 'Verification helps protect users, supports compliance obligations, and reduces fraud exposure across transactions.'],
            ['category' => 'Account & Verification', 'question' => 'What documents are commonly required for verification?', 'answer' => 'Most users provide a valid government-issued ID and profile details that match account information. Additional checks may apply for risk-based review.'],
            ['category' => 'Account & Verification', 'question' => 'How long does account verification take?', 'answer' => 'Many verifications are completed quickly, but timing can vary when additional checks are required for security or compliance.'],
            ['category' => 'Account & Verification', 'question' => 'What should I do if my verification is rejected?', 'answer' => 'Review the reason provided, correct document quality or data mismatch issues, then resubmit. Contact support if rejection continues.'],
            ['category' => 'Account & Verification', 'question' => 'Can I update my profile details after verification?', 'answer' => 'Yes, but sensitive fields may trigger re-verification to keep account and transaction data trusted and consistent.'],
            ['category' => 'Account & Verification', 'question' => 'Why was my account temporarily limited?', 'answer' => 'Limits can be applied when security signals or compliance checks require additional review before full access is restored.'],
            ['category' => 'Account & Verification', 'question' => 'Can business users verify on MoneySwap?', 'answer' => 'Where available, business onboarding may require additional documents and ownership checks before advanced limits are granted.'],

            ['category' => 'Swaps & Requests', 'question' => 'What is the difference between a swap request and a bid?', 'answer' => 'A request states what you want to exchange, while a bid is an offer submitted against an open request.'],
            ['category' => 'Swaps & Requests', 'question' => 'How are exchange rates shown on MoneySwap?', 'answer' => 'Rates are shown in transaction context so you can compare options before accepting or publishing a swap.'],
            ['category' => 'Swaps & Requests', 'question' => 'Can I cancel a request after posting it?', 'answer' => 'You can cancel open requests that have not been finalized. Active trades may follow stricter cancellation rules.'],
            ['category' => 'Swaps & Requests', 'question' => 'How long does it take to complete a swap?', 'answer' => 'Completion time depends on matching speed, counterparty response, and payment confirmation on both sides.'],
            ['category' => 'Swaps & Requests', 'question' => 'What happens after I accept an offer?', 'answer' => 'The transaction moves into confirmation and settlement stages, with status updates available in your dashboard.'],
            ['category' => 'Swaps & Requests', 'question' => 'Can I edit a request after publishing it?', 'answer' => 'Editable fields depend on transaction state. Open requests are typically editable; locked or active trades are not.'],
            ['category' => 'Swaps & Requests', 'question' => 'Can one request receive multiple offers?', 'answer' => 'Yes. You may receive multiple offers and can proceed with the one that best matches your timing and rate preference.'],
            ['category' => 'Swaps & Requests', 'question' => 'What should I do if the counterparty stops responding?', 'answer' => 'Use in-platform status controls and open a support ticket with the transaction reference if progress stalls.'],
            ['category' => 'Swaps & Requests', 'question' => 'What does pending confirmation mean?', 'answer' => 'It means one or more required confirmations are still outstanding before the swap can move to settlement.'],

            ['category' => 'Fees & Pricing', 'question' => 'Does MoneySwap charge transaction fees?', 'answer' => 'Yes. Applicable fees are presented before final confirmation so pricing remains transparent.'],
            ['category' => 'Fees & Pricing', 'question' => 'Are there hidden charges on swaps?', 'answer' => 'No hidden fees should apply. Always review the fee and amount summary shown before confirming.'],
            ['category' => 'Fees & Pricing', 'question' => 'Can fees vary by transaction type or amount?', 'answer' => 'Yes. Fees can vary based on amount, currency pair, settlement method, and risk profile.'],
            ['category' => 'Fees & Pricing', 'question' => 'When exactly are fees displayed?', 'answer' => 'Fees are shown at decision points before you submit or confirm a transaction.'],
            ['category' => 'Fees & Pricing', 'question' => 'Do displayed rates include fees?', 'answer' => 'Rates and fees are shown clearly in context so you can evaluate net value before proceeding.'],

            ['category' => 'Security & Safety', 'question' => 'How does MoneySwap protect my account?', 'answer' => 'MoneySwap uses layered controls such as account authentication, verification workflows, and transaction monitoring to reduce risk.'],
            ['category' => 'Security & Safety', 'question' => 'What should I do if I suspect unauthorized activity?', 'answer' => 'Reset your password immediately, review recent activity, and report the issue to support with account and transaction references.'],
            ['category' => 'Security & Safety', 'question' => 'How can I avoid swap fraud risks?', 'answer' => 'Stay within approved in-platform flows, verify details before action, and avoid off-platform settlement arrangements.'],
            ['category' => 'Security & Safety', 'question' => 'Will MoneySwap ever ask for my password?', 'answer' => 'No. Never share your password, one-time codes, or full authentication credentials with anyone.'],
            ['category' => 'Security & Safety', 'question' => 'What if I lose my phone or signed-in device?', 'answer' => 'Sign out of active sessions where available, change your password, and notify support if suspicious activity appears.'],
            ['category' => 'Security & Safety', 'question' => 'How do I keep my account safer daily?', 'answer' => 'Use a strong unique password, protect your email account, and verify every transaction detail before confirmation.'],

            ['category' => 'Payouts & Limits', 'question' => 'Are there daily or per-transaction limits?', 'answer' => 'Yes. Limits can depend on verification level, transaction history, and risk settings.'],
            ['category' => 'Payouts & Limits', 'question' => 'How do I receive funds after a successful swap?', 'answer' => 'Funds are settled through the configured payout route after completion checks are satisfied.'],
            ['category' => 'Payouts & Limits', 'question' => 'Can I track payout status in real time?', 'answer' => 'Yes. Payout and transaction states are visible in your dashboard with stage-based updates.'],
            ['category' => 'Payouts & Limits', 'question' => 'Why is my payout taking longer than expected?', 'answer' => 'Delays can occur during compliance review, bank processing windows, or when confirmation data is incomplete.'],
            ['category' => 'Payouts & Limits', 'question' => 'How can I increase my transaction limits?', 'answer' => 'Complete required verification milestones and maintain a strong transaction history where higher tiers are supported.'],

            ['category' => 'Disputes & Support', 'question' => 'What happens if a swap is disputed?', 'answer' => 'Submit a support ticket with the transaction reference. The team reviews logs, evidence, and timeline details for resolution.'],
            ['category' => 'Disputes & Support', 'question' => 'How can I contact MoneySwap support?', 'answer' => 'Use the official support channels provided in-app or on official pages, and include your transaction ID for faster response.'],
            ['category' => 'Disputes & Support', 'question' => 'What details should I include in a support ticket?', 'answer' => 'Include your account email, transaction reference, issue summary, and clear screenshots or timestamps when available.'],
            ['category' => 'Disputes & Support', 'question' => 'How quickly does support respond?', 'answer' => 'Response time varies by queue volume and issue complexity, but complete tickets are prioritized for faster handling.'],
            ['category' => 'Disputes & Support', 'question' => 'Can I escalate an unresolved issue?', 'answer' => 'Yes. If your issue remains unresolved, request escalation through the support thread and reference prior ticket history.'],
        ];

        foreach ($faqs as $faq) {
            $categoryId = $categoryIds[$faq['category']] ?? $generalId;
            if (!$categoryId) {
                continue;
            }

            $slug = substr(Str::slug($faq['question']), 0, 150);
            $answer = $this->applyConversionTone($faq['category'], $faq['answer']);
            $existing = DB::table('faqs')->where('question', $faq['question'])->first();

            if ($existing) {
                DB::table('faqs')->where('id', $existing->id)->update([
                    'faq_category_id' => $categoryId,
                    'answer' => $answer,
                    'slug' => $slug,
                    'published' => 1,
                    'updated_at' => $now,
                ]);
                continue;
            }

            DB::table('faqs')->insert([
                'faq_category_id' => $categoryId,
                'question' => $faq['question'],
                'answer' => $answer,
                'slug' => $slug,
                'published' => 1,
                'created_at' => $now,
                'updated_at' => $now,
            ]);
        }
    }

    private function applyConversionTone($category, $answer)
    {
        $answer = trim((string) $answer);
        $answer = preg_replace('/\s+/', ' ', $answer);
        $answer = rtrim($answer, " \t\n\r\0\x0B.");

        $ctaByCategory = [
            'General' => 'Next step: create your account and start with the guided flow.',
            'Getting Started' => 'Next step: open your dashboard and complete your first setup action now.',
            'Account & Verification' => 'Next step: submit complete details once to unlock smoother transactions.',
            'Swaps & Requests' => 'Next step: publish or accept a swap and track progress live in your dashboard.',
            'Fees & Pricing' => 'Next step: review the fee breakdown, then confirm with full cost clarity.',
            'Security & Safety' => 'Next step: enable strong account hygiene and transact only within platform-approved steps.',
            'Payouts & Limits' => 'Next step: verify your payout settings so settlement can complete without delay.',
            'Disputes & Support' => 'Next step: submit complete ticket details so support can resolve faster.',
        ];

        $cta = $ctaByCategory[$category] ?? 'Next step: continue in your dashboard to complete your transaction.';

        return $answer . '. ' . $cta;
    }
}
