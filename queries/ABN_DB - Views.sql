
-- Posts
CREATE VIEW [Posts] 
AS
	SELECT
		  [JobPosts].[jobPostID]
		, [JobPosts].[jobTitle]
		, [JobPosts].[jobType]
		, [JobPosts].[field]
		, [JobPosts].[description]
		, [JobPosts].[minSalary]
		, [JobPosts].[maxSalary]
		, [JobPosts].[dateCreated]
		, [Employers].[employerID]
		, [Employers].[profilePic]
		, [Employers].[companyName]
		, [Employers].[brgyDistrict]
		, [Employers].[cityProvince]
		, [Employers].[brgyDistrict] + ', ' + [Employers].[cityProvince] AS [location]
	FROM [JobPosts]
	INNER JOIN [Employers] 
		ON [JobPosts].[employerID] = [Employers].[employerID]
		AND [jobPostFlag] = 1
;
