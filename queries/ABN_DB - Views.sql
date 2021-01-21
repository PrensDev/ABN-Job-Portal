
-- Posts
CREATE VIEW [Posts] 
AS
	SELECT
		  [J].[jobPostID]
		, [J].[jobTitle]
		, [J].[jobType]
		, [J].[field]
		, [J].[description]
		, [J].[minSalary]
		, [J].[maxSalary]
		, [J].[dateCreated]
		, [E].[employerID]
		, [E].[profilePic]
		, [E].[companyName]
		, [E].[brgyDistrict]
		, [E].[cityProvince]
		, [E].[brgyDistrict] 
			+ ', ' 
			+ [E].[cityProvince] 
			AS [location]
	FROM [JobPosts] AS [J]
	INNER JOIN [Employers] AS [E] 
		ON [J].[employerID] = [E].[employerID]
		AND [J].[jobPostFlag] = 1
;
